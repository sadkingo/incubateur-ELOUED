<!-- laravel style -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/js/config.js') }}"></script>

<!-- beautify ignore:end -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');

</script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.1.2/jquery.repeater.js"></script> --}}
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}?v={{ time() }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/mine.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">
<script src="{{ asset('assets/js/dropzone-min.js') }}?v={{ time() }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}?v={{ time() }}" />


