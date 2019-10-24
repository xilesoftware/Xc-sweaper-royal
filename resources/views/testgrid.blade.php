<div class="map">
    @foreach($map as $y => $rows)
        <div class="map-row">
            @foreach($rows as $x => $cell)
                <div class="cell valid-move {{ ($check['y'] == $y && $check['x'] == $x)?'check':'' }}">
                    @if($cell['type'] == "mine")
                        X
                    @else
                        {{-- {{ $x }}<br>{{ $y }} --}}
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>
<div>
    {{ json_encode($check) }}
</div>

<style>

:root {
    --columns: 50;
    --rows: 25;
    --grid-gap: 2px;
}

.map{
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: repeat(var(--rows), 20px);
    background: #ccc;
    width: calc(1000px + var(--grid-gap) * var(--columns) - var(--grid-gap));
    height: calc(500px + var(--grid-gap) * var(--rows) - var(--grid-gap));;
    grid-gap: var(--grid-gap);
    border: 2px solid #ccc;
}
.map .map-row{
    display: grid;
    grid-template-columns: repeat(var(--columns), 20px);
    grid-template-rows: 1fr;
    grid-gap: var(--grid-gap);
}
.cell{
    background: #eee;
    width: 20px;
    height: 20px;
    display: grid;
    place-items: center;
    color: #aaa;
    user-select: none;
    font-size: 8px;
    font-family: Monospace;
    text-align: center;
}
.cell:hover{
    background: #ddd;
}
.cell.valid-move:hover{
    cursor: pointer;
}
.cell.check{
    background: #f00;
}
</style>