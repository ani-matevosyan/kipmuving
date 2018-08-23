@extends('site.adminAgency.layouts.default')

{{-- Content --}}
@section('content')
    <div class="under-header"></div>
    <div class="container-fluid">

        <div id="providersTable"></div>
    </div>


@stop

<script type="text/javascript">
    const providersTableData = JSON.parse('{!! json_encode($providers) !!}');
</script>