let timer;

function slide(n) {
	width = document.querySelector(".slides .col").offsetWidth + 20;
	count = 3;
	if(n >= count) n = 0;	
	if(n < 0) n = count - 1;
	document.querySelector(".slides").style.left = `-${width * n}px`;
	clearTimeout(timer);
	timer = setTimeout(() => slide(++n), 3000);
}

function sorting(id, sort) {
	let storage = [];
	let parent = document.getElementById(id);
	document.querySelectorAll(`#${id} .col`).forEach(elem => storage.push(elem));
	storage.sort((a, b) => 
		a.querySelector(`#${sort}`).innerHTML >
		b.querySelector(`#${sort}`).innerHTML ? 1 : -1
	);
	parent.innerHTML = "";
	storage.forEach(element => parent.innerHTML += element.outerHTML);
}