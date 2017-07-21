<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/select2.min.js')}}"></script>

    <script type="text/javascript" src="{{ asset('js/style.js') }}"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

     <script>
        
    tinymce.init({

        selector: 'textarea',
        plugins: 'link'
    });

    </script>

  </body>
</html>
