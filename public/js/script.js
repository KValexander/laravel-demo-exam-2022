let timer;

function slide(n) {
	let width = document.querySelector(".slides .col").offsetWidth + 21;
	let count = 3;

	if(n >= count) n = 0;

	document.querySelector(".slides").style.left = `-${width * n}px`;

	clearTimeout(timer);
	timer = setTimeout(() => slide(++n), 3000);
}

function sorting(id, sort) {
	let storage = [];
	let parent = document.getElementById(id);
	document.querySelectorAll(`#${id} .col`).forEach(element => {
		element.classList.remove("none");
		storage.push(element);
	});
	storage.sort((a, b) =>
		a.querySelector(`#${sort}`).innerHTML >
		b.querySelector(`#${sort}`).innerHTML ? 1 : -1
	);
	
	parent.innerHTML = "";
	storage.forEach(element => parent.innerHTML += element.outerHTML);
}

function filtration(id, key, value) {
	let parent = document.getElementById(id);
	document.querySelectorAll(`#${id} .col`).forEach(elem => {
		elem.classList.remove("none");
		if(key == "all" || value == "all") return;
		prop = elem.querySelector(`#${key}`).innerHTML;
		if(prop != value)
			elem.classList.add("none");
	});
}