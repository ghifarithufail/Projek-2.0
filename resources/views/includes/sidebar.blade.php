 <!-- SIDEBAR -->
 @if (Auth::user()->role == '1')
     <a href="#" class="brand">
         <img src="/img/logoge.png" style="border-radius: 30%; width: 50px; height: 50px; margin-right: 10px">
         GERINDRA
     </a>
     <ul class="side-menu">

         <li><a href="/chart" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
         <li class="divider" data-text="User">User</li>
         <li>
             <a href="{{ route('user') }}"><i class='bx bxs-user-plus icon'></i> User</a>
         </li>
         <li class="divider" data-text="koordinator">KOORDINATOR</li>
         <li>
             <a href=""><i class='bx bxs-user-check icon'></i> Koordiantor <i
                     class='bx bx-chevron-right icon-right'></i></a>
             <ul class="side-dropdown">
                 <li><a href="{{ route('korcam') }}"><i class='bx bxs-bank icon'></i> Korcam</a></li>
                 <li><a href="{{ route('korhan') }}"><i class='bx bxs-school icon'></i> Korlur</a></li>
                 <li><a href="{{ route('kortps') }}"><i class='bx bxs-home icon'></i> Kortps</a></li>
             </ul>
         </li>

         <li class="divider" data-text="Data">Data</li>
         <li>
             <a href="{{ route('suara') }}"><i class='bx bxs-user icon'></i> Suara Caleg</a>
         </li>
         <li>
             <a href="{{ route('anggota') }}"><i class='bx bxs-user icon'></i> Konstituante</a>
         </li>
         <li>
             <a href="{{ route('anggota/verifikasi') }}"><i class='bx bxs-user icon'></i>Verifikasi Konstituante</a>
         </li>
         {{-- <li>
             <a href="{{ route('dapil') }}"><i class='bx bxs-building icon'></i> Dapil</a>
         </li>
         <li>
             <a href="{{ route('partai') }}"><i class='bx bxs-buildings icon'></i> Partai</a>
         </li>
         <li>
             <a href="{{ route('caleg') }}"><i class='bx bxs-user-badge icon'></i> Caleg</a>
         </li> --}}
         <li class="divider" data-text="Report">Report</li>

         <li>
             <a href="{{ route('kelurahan') }}"><i class='bx bxs-home icon'></i> Kelurahan</a>
         </li>
         <li>
             <a href="{{ route('tps') }}"><i class='bx bxs-dock-top icon'></i> TPS</a>
         </li>
         <li>
             <a href="{{ route('korcam/report') }}"><i class='bx bxs-file-doc icon'></i> Korcam</a>
         </li>
         <li>
             <a href="{{ route('korhan/report') }}"><i class='bx bxs-news icon'></i> Korlur</a>
         </li>
         <li>
             <a href="{{ route('kortps/report') }}"><i class='bx bxs-id-card icon'></i> Kortps</a>
         </li>
     </ul>
 @endif
 <!-- SIDEBAR -->
 @if (Auth::user()->role == '2')
     <a href="#" class="brand">
         <img src="/img/logoge.png" style="border-radius: 30%; width: 50px; height: 50px; margin-right: 10px">
         GERINDRA
     </a>
     <ul class="side-menu">
         <li><a href="" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
         <li class="divider" data-text="koordinator">KOORDINATOR</li>
         <li>
             <a href=""><i class='bx bxs-user-check icon'></i> Koordiantor <i
                     class='bx bx-chevron-right icon-right'></i></a>
             <ul class="side-dropdown">
                 <li><a href="{{ route('korcam') }}"><i class='bx bxs-bank icon'></i> Korcam</a></li>
                 <li><a href="{{ route('korhan') }}"><i class='bx bxs-school icon'></i> Korlur</a></li>
                 <li><a href="{{ route('kortps') }}"><i class='bx bxs-home icon'></i> Kortps</a></li>
             </ul>
         </li>
         <li>
             <a href="{{ route('anggota') }}"><i class='bx bxs-user icon'></i> Anggota</a>
         </li>
     </ul>
 @endif
 @if (Auth::user()->role == '3')
     <a href="#" class="brand">
         <img src="/img/logoge.png" style="border-radius: 30%; width: 50px; height: 50px; margin-right: 10px">
         GERINDRA
     </a>
     <ul class="side-menu">
         <li><a href="" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
         <li class="divider" data-text="koordinator">KOORDINATOR</li>
         <li>
             <a href=""><i class='bx bxs-user-check icon'></i> Koordiantor <i
                     class='bx bx-chevron-right icon-right'></i></a>
             <ul class="side-dropdown">
                 <li><a href="{{ route('korhan') }}"><i class='bx bxs-school icon'></i> Korlur</a></li>
                 <li><a href="{{ route('kortps') }}"><i class='bx bxs-home icon'></i> Kortps</a></li>
             </ul>
         </li>
         <li>
             <a href="{{ route('anggota') }}"><i class='bx bxs-user icon'></i> Anggota</a>
         </li>
     </ul>
 @endif
 @if (Auth::user()->role == '4')
 <a href="#" class="brand">
	<img src="/img/logoge.png" style="border-radius: 30%; width: 50px; height: 50px; margin-right: 10px">
	GERINDRA
</a>
     <ul class="side-menu">
         <li><a href="" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
         <li class="divider" data-text="koordinator">KOORDINATOR</li>
         <li>
             <a href=""><i class='bx bxs-user-check icon'></i> Koordiantor <i
                     class='bx bx-chevron-right icon-right'></i></a>
             <ul class="side-dropdown">
                 <li><a href="{{ route('kortps') }}"><i class='bx bxs-home icon'></i> Kortps</a></li>
             </ul>
         </li>
         <li>
             <a href="{{ route('anggota') }}"><i class='bx bxs-user icon'></i> Anggota</a>
         </li>
     </ul>
 @endif
 @if (Auth::user()->role == '5')
 <a href="#" class="brand">
	<img src="/img/logoge.png" style="border-radius: 30%; width: 50px; height: 50px; margin-right: 10px">
	GERINDRA
</a>
     <ul class="side-menu">

         <li><a href="" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
         <li class="divider" data-text="User">User</li>
         <li>
             <a href="{{ route('user') }}"><i class='bx bxs-user-plus icon'></i> User</a>
         </li>
         <li class="divider" data-text="koordinator">KOORDINATOR</li>
         <li>
             <a href=""><i class='bx bxs-user-check icon'></i> Koordiantor <i
                     class='bx bx-chevron-right icon-right'></i></a>
             <ul class="side-dropdown">
                 <li><a href="{{ route('korcam') }}"><i class='bx bxs-bank icon'></i> Korcam</a></li>
                 <li><a href="{{ route('korhan') }}"><i class='bx bxs-school icon'></i> Korlur</a></li>
                 <li><a href="{{ route('kortps') }}"><i class='bx bxs-home icon'></i> Kortps</a></li>
             </ul>
         </li>

         <li class="divider" data-text="Data">Data</li>
         <li>
             <a href="{{ route('suara') }}"><i class='bx bxs-user icon'></i> Suara Caleg</a>
         </li>
         <li>
             <a href="{{ route('anggota') }}"><i class='bx bxs-user icon'></i> Konstituante</a>
         </li>
         <li>
             <a href="{{ route('anggota/verifikasi') }}"><i class='bx bxs-user icon'></i>Verifikasi Konstituante</a>
         </li>
         <li class="divider" data-text="Report">Report</li>

         <li>
             <a href="{{ route('kelurahan') }}"><i class='bx bxs-home icon'></i> Kelurahan</a>
         </li>
         <li>
             <a href="{{ route('tps') }}"><i class='bx bxs-dock-top icon'></i> TPS</a>
         </li>
         <li>
             <a href="{{ route('korcam/report') }}"><i class='bx bxs-file-doc icon'></i> Korcam</a>
         </li>
         <li>
             <a href="{{ route('korhan/report') }}"><i class='bx bxs-news icon'></i> Korlur</a>
         </li>
         <li>
             <a href="{{ route('kortps/report') }}"><i class='bx bxs-id-card icon'></i> Kortps</a>
         </li>
     </ul>
 @endif
 <!-- SIDEBAR -->
