<!-- NAVBAR -->
<style>
	/* Initially hide the dropdown and set the transition */
	ul.profile-link {
	  display: none;
	  opacity: 0;
	  transition: opacity 0.3s ease-in-out;
	}
  
	/* Show the dropdown when the 'show' class is added */
	ul.profile-link.show {
	  display: block;
	  opacity: 1;
	}
  
	#dropdown-icon {
	  cursor: pointer;
	}
  </style>
  
  <nav>
      <i class='bx bx-menu toggle-sidebar'></i>
      <form action="#"></form>
      <span class="divider"></span>
      <div class="profile">
          <box-icon name='menu' id="dropdown-icon"></box-icon>
          <ul class="profile-link" id="dropdown-content">
              <li><a href="/logout"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
          </ul>
      </div>
  </nav>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const dropdownIcon = document.getElementById('dropdown-icon');
          const dropdownContent = document.getElementById('dropdown-content');

          dropdownIcon.addEventListener('click', function() {
              dropdownContent.classList.toggle('show');
          });

          // Close the dropdown when clicking outside of it
          window.addEventListener('click', function(event) {
              if (!event.target.matches('#dropdown-icon')) {
                  if (dropdownContent.classList.contains('show')) {
                      dropdownContent.classList.remove('show');
                  }
              }
          });
      });
  </script>
  <!-- NAVBAR -->