const SortNew = document.querySelector('.sort_nav01'); //최신순 버튼
const SortKor = document.querySelector('.sort_nav02'); //가나다순 버튼
const SortHighPrice = document.querySelector('.sort_nav03'); //높은가격순 버튼
const SortLowPrice = document.querySelector('.sort_nav04'); //낮은가격순 버튼

//최신순으로 정렬
SortNew.addEventListener('click', function () {
	SortKor.style.backgroundColor = ' rgb(212, 212, 212)';
	SortNew.style.backgroundColor = 'rgb(255, 198, 42)';
	SortLowPrice.style.backgroundColor = ' rgb(212, 212, 212)';
	SortHighPrice.style.backgroundColor = ' rgb(212, 212, 212)';
	location.href='index.php?sort=SUBSTRING(content_code, 1, 6)&dir=desc&btn=1'
});
//높은가격순으로 정렬
SortHighPrice.addEventListener('click', function () {
	SortHighPrice.style.backgroundColor = 'rgb(255, 198, 42)';
	SortNew.style.backgroundColor = ' rgb(212, 212, 212)';
	SortLowPrice.style.backgroundColor = ' rgb(212, 212, 212)';
	SortKor.style.backgroundColor = ' rgb(212, 212, 212)';
	location.href='index.php?sort=content_price&dir=desc&btn=3'
});
//낮은가격순으로 정렬
SortLowPrice.addEventListener('click', function () {
	SortHighPrice.style.backgroundColor = ' rgb(212, 212, 212)';
	SortNew.style.backgroundColor = ' rgb(212, 212, 212)';
	SortLowPrice.style.backgroundColor = 'rgb(255, 198, 42)';
	SortKor.style.backgroundColor = ' rgb(212, 212, 212)';
	location.href='index.php?sort=content_price&dir=asc&btn=4'
});
//가나다순으로 정렬
SortKor.addEventListener('click', function () {
	SortHighPrice.style.backgroundColor = ' rgb(212, 212, 212)';
	SortNew.style.backgroundColor = ' rgb(212, 212, 212)';
	SortLowPrice.style.backgroundColor = ' rgb(212, 212, 212)';
	SortKor.style.backgroundColor = 'rgb(255, 198, 42)';
	location.href='index.php?sort=content_name&dir=asc&btn=2'
});

// const SortNew = $('#sort_nav01');
// const SortKor = $('#sort_nav02');
// const SortLowPrice = $('#sort_nav03');
// const SortHighPrice = $('#sort_nav04');

// // 세션 스토리지에 저장된 선택된 버튼 ID를 가져와서 CSS를 설정
// function applyButtonState() {
//     const selectedButtonId = sessionStorage.getItem('selectedButtonId');

//     if (selectedButtonId) {
//         $('#' + selectedButtonId).css('background-color', 'rgb(255, 198, 42)');
//     }
// }

// // 초기 페이지 로딩 시 선택된 버튼에 대한 CSS 설정
// applyButtonState();

// // 버튼 클릭 이벤트 핸들러에 추가
// SortNew.on('click', function () {
//     sortProducts('SUBSTRING(content_code, 1, 6)', 'asc');
//     resetButtonColors();
//     $(this).css('background-color', 'rgb(255, 198, 42)');
//     sessionStorage.setItem('selectedButtonId', 'sort_nav01');
// });

// SortKor.on('click', function () {
//     sortProducts('content_name', 'asc');
//     resetButtonColors();
//     $(this).css('background-color', 'rgb(255, 198, 42)');
//     sessionStorage.setItem('selectedButtonId', 'sort_nav02');
// });

// SortHighPrice.on('click', function () {
//     sortProducts('content_price', 'desc');
//     resetButtonColors();
//     $(this).css('background-color', 'rgb(255, 198, 42)');
//     sessionStorage.setItem('selectedButtonId', 'sort_nav04');
// });

// SortLowPrice.on('click', function () {
//     sortProducts('content_price', 'asc');
//     resetButtonColors();
//     $(this).css('background-color', 'rgb(255, 198, 42)');
//     sessionStorage.setItem('selectedButtonId', 'sort_nav03');
// });
