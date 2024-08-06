<script type="text/javascript">
    @foreach($namespaces as $namespace => $variables)
        window.{{ $namespace }} = {{ \Illuminate\Support\Js::from($variables) }};
    @endforeach
</script>