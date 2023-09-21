	<!-- SIDEBAR -->
		<a href="#" class="brand"><i class='bx bxs-smile icon'></i> AdminSite</a>
		<ul class="side-menu">
			<li><a href="" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="koordinator">KOORDINATOR</li>
			<li>
				<a href=""><i class='bx bxs-inbox icon' ></i> Koordiantor <i class='bx bx-chevron-right icon-right'></i></a>
				<ul class="side-dropdown">
					<li><a href="{{ route('korcam') }}"><i class='bx bxs-chart icon' ></i> Korcam</a></li>
					<li><a href="{{ route('korhan') }}"><i class='bx bxs-chart icon' ></i> Korhan</a></li>
					<li><a href="{{ route('kortps') }}"><i class='bx bxs-chart icon' ></i> Kortps</a></li>
				</ul>
			</li>
			{{-- <li>
				<a href="{{ route('korcam') }}"><i class='bx bxs-chart icon' ></i> Korcam</a>
			</li>
			<li>
				<a href="{{ route('korhan') }}"><i class='bx bxs-chart icon' ></i> Korhan</a>
			</li>
			<li>
				<a href="{{ route('kortps') }}"><i class='bx bxs-chart icon' ></i> Kortps</a>
			</li> --}}
			<li class="divider" data-text="Data">Data</li>
			<li>
				<a href="{{ route('logout') }}"><i class='bx bxs-widget icon' ></i> Log Out</a>
			</li>
			<li>
				<a href="{{ route('anggota') }}"><i class='bx bxs-widget icon' ></i> Anggota</a>
			</li>
			<li>
				<a href="{{ route('dapil') }}"><i class='bx bxs-widget icon' ></i> Dapil</a>
			</li>
			<li>
				<a href="{{ route('partai') }}"><i class='bx bxs-widget icon' ></i> Partai</a>
			</li>
			<li>
				<a href="{{ route('caleg') }}"><i class='bx bxs-widget icon' ></i> Caleg</a>
			</li>
			<li class="divider" data-text="Report">Report</li>

			<li>
				<a href="{{ route('kelurahan') }}"><i class='bx bxs-widget icon' ></i> Kelurahan</a>
			</li>
			<li>
				<a href="{{ route('tps') }}"><i class='bx bxs-widget icon' ></i> TPS</a>
			</li>
			<li>
				<a href="{{ route('korcam/report') }}"><i class='bx bxs-widget icon' ></i> Korcam</a>
			</li>
			<li>
				<a href="{{ route('korhan/report') }}"><i class='bx bxs-widget icon' ></i> Korhan</a>
			</li>
			<li>
				<a href="{{ route('kortps/report') }}"><i class='bx bxs-widget icon' ></i> Kortps</a>
			</li>
			<li class="divider" data-text="table and forms">Table and forms</li>
			<li>
				<a href="#"><i class='bx bx-table icon' ></i> Tables</a>
			</li>
			{{-- <li>
				<a href="#"><i class='bx bxs-notepad icon' ></i> Forms <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="#">Basic</a></li>
					<li><a href="#">Select</a></li>
					<li><a href="#">Checkbox</a></li>
					<li><a href="#">Radio</a></li>
				</ul>
			</li> --}}
		</ul>
	<!-- SIDEBAR -->