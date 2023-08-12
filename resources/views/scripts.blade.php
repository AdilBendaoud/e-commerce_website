<!-- jquery script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- toastr script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- datatable script -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- bootstrap script -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js" integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- app script -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    let table = new DataTable('#myTable');
</script>
@if(Session::has('success'))
    <script>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ Session::get('success') }}")
    </script>
@endif

@if(Session::has('error'))
    <script>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
    </script>
@endif

@if(Session::has('info'))
    <script>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
    </script>
@endif

@if(Session::has('warning'))
    <script>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
    </script>
@endif

<script>
    const inputs = document.getElementsByClassName('cover_image')
    for(let i = 0; i < inputs.length; i++){
        inputs[i].addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            const imagePreview = this.parentElement.nextElementSibling
            reader.onload = function (e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="mx-auto" alt="Preview Image">`;
                imagePreview.childNodes[0].style.height="150px"
            };

            reader.readAsDataURL(file);
        }
        });
    }
    const additional_images_inputs = document.getElementsByClassName('additional_images');
    for(let i = 0; i < additional_images_inputs.length; i++){
        additional_images_inputs[i].addEventListener('change', function (event) {
        const files = event.target.files;

        if (files) {
            const imagePreview = this.parentElement.nextElementSibling;
            imagePreview.style.display="flex";
            imagePreview.style.flexWrap="wrap";
            imagePreview.style.justifyContent="center";
            imagePreview.innerHTML = '';

            for (let i = 0; i < files.length; i++){
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const image = document.createElement('img');
                    image.src = e.target.result;
                    image.alt = 'Preview Image';
                    image.style.height = '150px';
                    image.style.width = '150px';
                    image.style.aspectRatio = '1/1';
                    imagePreview.appendChild(image);
                };
                reader.readAsDataURL(file);
            }
        }
        });
    }
    
    const deleteImageBtns = document.getElementsByClassName('closeBtn');
    for(let i=0;i<deleteImageBtns.length;i++){
        deleteImageBtns[i].addEventListener('click',(e)=>{
            e.preventDefault();
            const imageElm = e.target.parentElement.nextElementSibling;
            const imagePath = imageElm.src;
            const baseUrl = "http://127.0.0.1:8000/storage";
            const trimmedImageUrl = imagePath.replace(baseUrl, "");
            $.ajax({
                url: '{{ route("delete.image") }}',
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    image_url: trimmedImageUrl,
                },
                success: function(response) {
                    console.log(response.message);
                    $(imageElm.parentElement).fadeOut(350);
                },
                error: function(error) {
                    console.error('Error deleting image:', error);
                }
            });
        })
    }

    $('.open-update-product-modal').on('click', function() {
    const productId = $(this).data('product-id');
    
        $.ajax({
            url: `/productsInfo/${productId}`,
            method: 'GET',
            success: function(response) {
                const product = response.product;
                populateUpdateModal(product);
            },
            error: function(error) {
                console.error('Error fetching old data:', error);
            }
        });
    });

    function populateUpdateModal(product){
        $(`#name${product.id}`).val(product.name);
        $(`#description${product.id}`).val(product.description);
        $(`#list_price${product.id}`).val(product.list_price);
        $(`#sale_price${product.id}`).val(product.sale_price);
        $(`#quantity${product.id}`).val(product.quantity);
        $(`#productEditeModal${product.id}`).modal('show');
    }

    const dateInput = document.getElementById('order-filter-date');
    dateInput.addEventListener('change',function(e){
        const customInput = document.getElementById('custom-date-input');
        if(e.target.value == 'custom'){
            customInput.classList.remove("d-none");
        }else{
            customInput.classList.add("d-none");
       }
    })

</script>