if (document.getElementById('data-list')) {
	new simpleDatatables.DataTable("#data-list", {
		searchable: true,
		fixedHeight: false,
		perPage: 5
	});
};

// Toggle Sidenav
const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
const sidenav = document.getElementById('sidenav-main');
let body = document.getElementsByTagName('body')[0];
let className = 'g-sidenav-pinned';

function toggleSidenav() {
	if (body.classList.contains(className)) {
		body.classList.remove(className);
		setTimeout(function() {
		sidenav.classList.remove('bg-white');
		}, 100);
		sidenav.classList.remove('bg-transparent');

	} else {
		body.classList.add(className);
		sidenav.classList.add('bg-white');
		sidenav.classList.remove('bg-transparent');
	}
}