<?php

namespace App\Http\Controllers;

use App\Http\Requests\TreatmentUpload;
use App\Models\Treatment;
use App\Models\TreatmentDrug;
use App\Models\TreatmentFile;
use App\Models\TreatmentGeneInfo;
use App\Models\TreatmentTherapeuticArea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TreatmentController extends Controller
{
    public function index(): View
    {
        $treatment = Treatment::query()
            ->with(['file', 'drugs', 'geneInfo', 'therapeuticArea'])
            ->get()
            ->last();

        return view('treatment')->with('treatment', $treatment);
    }

    public function upload(TreatmentUpload $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $fileContent = json_decode(file_get_contents($request->file), true);
            $currentMedications = $fileContent['CurrentMedications'][0];

            $treatmentFile = $this->createTreatmentFile($fileContent);
            $treatmentFile->save();

            $treatment = $this->createTreatment($treatmentFile->getKey(), $currentMedications);
            $treatment->save();

            $treatmentId = $treatment->getKey();

            $this->createTreatmentDrugs($treatmentId, $currentMedications['Drugs'][0]);

            $this->createTreatmentGeneInfo($treatmentId, $currentMedications['GeneInfo']);

            $this->createTreatmentTherapeuticArea($treatmentId, $currentMedications['TheraputicArea']);

            DB::commit();

            return redirect()->route('treatments')->with('success', 'Treatment imported');
        } catch (\Exception $exception) {
            DB::rollBack();

            $baseMessage = 'Something went wrong importing the file.';

            Log::error($baseMessage,[
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $exception->getCode(),
            ]);

            return redirect()
                ->back()
                ->with('error', "$baseMessage Please contact the system administrator.");
        }
    }

    private function createTreatmentFile(array $fileContent): TreatmentFile
    {
        $treatmentFile = new TreatmentFile();

        $treatmentFile->sample_number = $fileContent['SampleNumber'];
        $treatmentFile->pipeline_version = $fileContent['PipelineVersion'];
        $treatmentFile->sequencer = $fileContent['Sequencer'];
        $treatmentFile->knowledge_version = $fileContent['KnowledgebaseVersion'];
        $treatmentFile->date_generated = $fileContent['DateGenerated'];

        return $treatmentFile;
    }

    private function createTreatment(int $fileId, array $CurrentMedications): Treatment
    {
        $treatment = new Treatment();
        $treatment->file_id = $fileId;
        $treatment->group_phenotype = $CurrentMedications['GroupPhenotype'];
        $treatment->action = $CurrentMedications['Action'][0];
        $treatment->recommendation = $CurrentMedications['Recommendation'];

        return $treatment;
    }

    private function createTreatmentDrugs(int $treatmentId, array $drugs): void
    {
        $treatmentDrug = new TreatmentDrug();
        $treatmentDrug->treatment_id = $treatmentId;
        $treatmentDrug->generic = $drugs['Generic'][0];
        $treatmentDrug->trade = $drugs['Trade'][0];

        $treatmentDrug->save();
    }

    private function createTreatmentGeneInfo(int $treatmentId, array $genesInfo): void
    {
        $finalGeneInfo = [];
        foreach ($genesInfo as $geneInfo) {
            $finalGeneInfo[] = [
                'treatment_id' => $treatmentId,
                'gene' => $geneInfo['Gene'],
                'genotype' => $geneInfo['Genotype'],
                'phenotype' => $geneInfo['Phenotype'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        TreatmentGeneInfo::insert($finalGeneInfo);
    }

    private function createTreatmentTherapeuticArea($treatmentId, $theraputicArea): void
    {
        $areas = [];

        foreach ($theraputicArea as $area) {
            $areas[] = [
                'treatment_id' => $treatmentId,
                'name' => $area,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        TreatmentTherapeuticArea::insert($areas);
    }
}
