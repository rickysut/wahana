@php echo "<?php" @endphp

@php
    echo "\$dataPage = array(". "\n"
@endphp
    @foreach ($solutions as $item)
    @php echo "'". \Str::slug($item->title) ."' => '". \Str::slug($item->title) .".php',". "\n" @endphp
    @endforeach
@php echo "
);"

@endphp