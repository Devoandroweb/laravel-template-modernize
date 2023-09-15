<script src="{{asset('libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/sidebarmenu.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="{{asset('js/datatables.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
		.create( document.querySelector( '#editor' ) )
		.catch( error => {
			console.error( error );
		} );
</script>
@stack('datatable')
@stack('js')
