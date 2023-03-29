<!-- Javascript -->
<script src="{{asset('backend')}}/assets/bundles/libscripts.bundle.js"></script>    
<script src="{{asset('backend')}}/assets/bundles/vendorscripts.bundle.js"></script>

<script src="{{asset('backend')}}/assets/bundles/chartist.bundle.js"></script>
<script src="{{asset('backend')}}/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->

<script src="{{asset('backend')}}/assets/bundles/mainscripts.bundle.js"></script>
<script src="{{asset('backend')}}/assets/js/index.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('backend')}}/assets/js/jquery.printPage.js"></script>  
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
@yield('scripts')
<script>
    $('document').ready(function()
{
    $('textarea').each(function(){
            $(this).val($(this).val().trim());
        }
    );
});
</script>

</body>
</html>