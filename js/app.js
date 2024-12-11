// 각 버튼에 대한 이벤트 핸들러 정의
document.getElementById('purchaseButton').addEventListener('click', function() {
    payNow();
});

// 장바구니 버튼 클릭 이벤트 핸들러 등록
document.getElementById('cartButton').addEventListener('click', function(event) {
	alert('장바구니에 추가되었습니다');
    event.stopPropagation(); // 이벤트 전파 중지
    cart_insert();
}, false);


    function cart_insert() {
	    console.log('cart_insert 함수 호출');
	    document.contents_form.submit();
	}
	
    function payNow() { 
		// 폼 데이터를 비동기적으로 서버에 전송
		var formData = new FormData(document.contents_form);

		var xhr = new XMLHttpRequest();
	 
		xhr.open('POST', 'paynow.php', true); // paynow.php로 변경
		// alert('장바구니에 해당상품을 담았습니다. 바로 해당 상품 결제 화면으로 이동합니다.');
		xhr.onload = function() {
		   // 서버 응답을 확인하고 필요한 작업을 수행
		   if (xhr.status === 200) {
			  // 서버 응답이 성공적이면 페이지 이동
			  location.href = "paydirect.php";
		   } else {
			  // 서버 응답이 실패하면 사용자에게 알림 등을 처리
			  alert('연결 실패]');
			  console.error('폼 데이터 전송 실패');
		   }
		};
	 
		xhr.send(formData);
	 }
	
	function add_img() {
	const add_img = prompt('추가할 이미지를 입력하세요.');
	return add_img;
	}
	
	//대분류, 소분류
	function Category_Change(e) {
	var outer = ['선택해주세요.', '가디건/조끼', '야상/점퍼', '패딩', '자켓/코트'];
	var top = ['선택해주세요.', '긴팔티셔츠', '맨투맨', '후드', '반팔/민소매'];
	var traning = [''];
	var basic = [''];
	var one_piece = [''];
	var skirt = [''];
	var pants = ['선택해주세요.', '청바지', '롱팬츠', '면바지', '슬랙스', '래깅스', '숏팬츠'];
	var bag = ['선택해주세요.', '백팩/스쿨백', '크로스/도트백'];
	var shoes = ['선택해주세요.', '운동화/단화', '구두/워커', '샌들/슬리퍼/장화'];
	var accessory = ['선택해주세요.', '주얼리', '모자/벨트', '양말/스타킹'];
	
	var target = document.getElementById('category_small');
	
	if (e.value == 'outer') var d = outer;
	else if (e.value == 'top') var d = top;
	else if (e.value == 'traning') var d = traning;
	else if (e.value == 'basic') var d = basic;
	else if (e.value == 'one_piece') var d = one_piece;
	else if (e.value == 'skirt') var d = skirt;
	else if (e.value == 'pants') var d = pants;
	else if (e.value == 'bag') var d = bag;
	else if (e.value == 'shoes') var d = shoes;
	else if (e.value == 'accessory') var d = accessory;
	
	target.options.length = 0;
	
	for (x in d) {
	var opt = document.createElement('option');
	opt.value = d[x];
	opt.innerHTML = d[x];
	target.appendChild(opt);
	}
	}
	
	//전체 상품구매시 전체 체크하기
	function select_all() {
	$('input:checkbox').prop('checked', true);
	}
	
	//전체선택시 전체 체크/ 전체 해제
	function checkAll() {
	if ($('.check_all').is(':checked') == true) {
	$('input:checkbox').prop('checked', true);
	} else {
	$('input:checkbox').prop('checked', false);
	}
	}
	
	//check_all(전체체크 박스)이 체크되어 있을때,
	// 상품체크를 해제하면 check_all도 해제하기
	function check_all_check() {
	$('.check_all').prop('checked', false);
	}
	
	//선택한 상품이 없으면 선택하라고 요청하기
	function CheckSelected() {
	if ($('input:checkbox:checked').length == 0) {
	alert('상품을 선택해 주세요.');
	} else {
	document.cart_form.submit();
	}
	}
	//선택한 상품이 없으면 선택하라고 요청하기
	function CheckDelete() {
	if ($('input:checkbox:checked').length == 0) {
	alert('상품을 선택해 주세요.');
	} else {
	document.cart_form.submit();
	console.log("장바구니삭제");
	}
	}
	
	
	//전체 상품구매시 전체 체크하기
	function CheckDeleteAll() {
	$('input:checkbox').prop('checked', true);
	document.cart_form.submit();
	console.log("장바구니삭제");
	}


	function handleAction(action) {
		var selectedItems = [];
	
		// 여기에서 선택된 상품들의 정보를 수집 (checkbox 등을 이용하여)
		$('input:checkbox:checked').each(function() {
			var contentCode = $(this).closest('tr').find('[name^="content_code"]').val();
			var contentAmount = $(this).closest('tr').find('[name^="content_amount"]').val();
			var contentOptions = $(this).closest('tr').find('[name^="content_options"]').val();
			
			selectedItems.push({
				content_code: contentCode,
				content_amount: contentAmount,
				content_options: contentOptions
			});
		});
	
		switch (action) {
			case 'deleteAll':
				// 서버에 전체 삭제 요청 전송
				if (selectedItems.length === 0) {
					// 선택된 체크박스가 없으면 모두 다 체크
					$('input:checkbox').prop('checked', true);
				}
	
				ajaxRequest('deleteAll.php', {}, function () {
					window.location.reload();
				});
				break;
	
			case 'deleteSelected':
				// 서버에 선택 삭제 요청 전송
				if (selectedItems.length > 0) {
					ajaxRequest('deleteSelected.php', { selectedItems: JSON.stringify(selectedItems) }, function () {
						window.location.reload();
					});
				} else {
					alert('상품을 선택해 주세요.');
				}
				break;
	
			// 나머지 동작에 대한 처리도 유사하게 추가할 수 있습니다.
	
			default:
				console.error('Unknown action');
				break;
		}
	}
	
	function ajaxRequest(url, data, callback) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				callback();
			}
		};
		var params = [];
		for (var key in data) {
			params.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
		}
		var paramString = params.join('&');
		xhr.send(paramString);
	}
	