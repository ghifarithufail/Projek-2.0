<!DOCTYPE html>
<html lang="en">
	
	{{-- HEAD --}}
		@include('includes.head')
	{{-- HEAD --}}
<body style="background: #F1F0F6;">
	<!-- SIDEBAR -->
	<section id="sidebar">
		@include('includes.sidebar')
		
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		@include('includes.navbar')
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main style="background-color: #F1F0F6;">
            @yield('content')
		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	@include('includes.js')
</body>
</html>