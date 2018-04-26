@extends('admin.layouts.master')

@section('content')


    <style>

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ asset('adminlte/plugins/formBuilder/dist/form-builder.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/formBuilder/dist/form-render.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/formBuilder/dist/control_plugins/starRating.min.js')}}"></script>

    <div id="fb-editor"></div>
    <div id="fb-rendered-form">
        <form action="#"></form>
        <button class="btn btn-default edit-form">Edit</button>
        <button class="btn btn-default copy-html" id="getHTML">Copy Html</button>
    </div>



    <script>
        document.getElementById('getHTML').addEventListener('click', function() {
            //$(document.getElementById('fb-editor')).actions.getData('html')


        });
        jQuery(function($) {
            var $fbEditor = $(document.getElementById('fb-editor')),
                    $formContainer = $(document.getElementById('fb-rendered-form')),
                    fbOptions = {
                        onSave: function() {
                            $fbEditor.toggle();
                            $formContainer.toggle();
                            $('form', $formContainer).formRender({
                                formData: formBuilder.formData
                            });


                            console.log(formBuilder.formData);
                        }
                    },
                    formBuilder = $fbEditor.formBuilder(fbOptions);


            $('.edit-form', $formContainer).click(function() {
                $fbEditor.toggle();
                $formContainer.toggle();
            });

            $('.copy-html', $formContainer).click(function() {

                var generated_form = '<form action="#" method="POST">' + $('.rendered-form').html() + '</form>';
                alert(generated_form);

            });
        });





    </script>

@endsection