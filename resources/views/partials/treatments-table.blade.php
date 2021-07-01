@if(!is_null($treatment))
    <div class="row mt-5">
        <h4>
            @foreach($treatment->therapeuticArea as $areas)
                {{$areas->name}}
            @endforeach
        </h4>
        <table id="pain-management-table" class="table table-striped">
            <caption>Data imported by JSON file</caption>
            <tr class="text-center">
                <th
                    scope="col"
                    rowspan="4"
                    class="bg-warning align-middle col-2"
                >
                    @foreach($treatment->drugs as $drug)
                        {{$drug->generic}} <br>
                        {{"($drug->trade)"}}
                    @endforeach
                </th>
                <th scope="col">Gene</th>
                <th scope="col">Genotype</th>
                <th scope="col"
                    class="bg-warning"
                >
                    Phenotypes / Patient Impact
                </th>
                <th
                    rowspan="4"
                    scope="col"
                    class="align-middle col-4 fw-normal"
                >
                    {{$treatment->recommendation}}
                </th>
            </tr>

            @foreach($treatment->geneInfo as $geneInfo)
                <tr class="text-center">
                    <td>{{$geneInfo->gene}}</td>
                    <td>{{$geneInfo->genotype}}</td>
                    <td class="bg-warning">
                        {{$geneInfo->phenotype}}
                    </td>
                </tr>
            @endforeach

            <tr class="text-center">
                <td colspan="2"
                    class="fw-bold text-white bg-warning"
                >
                    {{$treatment->action}}
                </td>
                <td class="fw-bold text-white bg-warning">
                    {{$treatment->group_phenotype}}
                </td>
            </tr>
        </table>
    </div>
@endif
