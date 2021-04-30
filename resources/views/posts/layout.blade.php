<!doctype html>
<html lang="ar" dir="" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Mark Otto</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/">
  <link href="{{ URL::asset('css/blog.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body style="background-color:#f5f5f5">
  <div style="margin-top:58px" class="container"> 
    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main mt-4">
          @yield('content') 
        </div>
        <aside class=" col-md-4 blog-sidebar mt-5">
          <div class="p-4 mb-3 bg-light rounded">
            <h4 class="">About</h4>
            <p class="mb-0">Etiam porta sem malesuada magna  mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>
          <div class="p-4">
            <h4 class="">Archives</h4>
            <ol class="list-unstyled mb-0">
{{--               @foreach ($archives as $archive)
            <li><a href="{{url('posts/'.$archive->year.'/'.$archive->month_number.'')}}">{{$archive->month . ' ' . $archive->year .' (' . $archive->post_count .')' }}</a></li>
              @endforeach   --}} 
            </ol>
          </div>
        </aside>
      </div>
    </main>
  </div>
</body>
<footer class="blog-footer">
  <p> Blog template built for</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
<!-- Bootstrap core JavaScript
==================================================-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/vendor/jquery-slim.min.js') }}"></script>
<script>window.jQuery || document.write('<script src="{{ asset('assets/js/vendor/jquery-slim.min.js') }}"><\/script>')</script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/vendor/holder.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- Import typeahead.js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<!-- Import typeahead.js -->
<script src="{{ asset('js/typeahead.bundle.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
    		var bloodhound = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: {
					url: '{{url("search")}}?searchname=%QUERY%',// أسم الرابط معرف في wep.php
					wildcard: '%QUERY%'
				},
			});
			$('#search').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'posts',
				source: bloodhound,
				limit:10,
				display: function(data) {
					return data.name  //Input value to be set when you select a suggestion. 
				},
				/* عرض الاقترحات بعد البداْ بالكتابة */
				templates: {
					/* عندما لايجد قيمة مطابقة  */
					empty: [
						'<li class="list-group-item font-weight-bold">Not Found Result ...</li>'
					],
					header: [
						'<ul class="list-group">'
					],
					/* في حالة وجد  */
					suggestion: function(data) {
		      return '<li class="list-group-item search-title">'+data.title+' <div class="search-body">' +data.excerpt+'</div>'
					
					}
				}
			});
        });
</script>
</body>
</html>

