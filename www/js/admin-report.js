$(function(){
	$('#load-report-1').click(function(){
		var group_id=$('select#report-sample-list option:selected').attr('value');
		$.ajax({
			url:"../reports/report1.php",
			type:"GET",
			success:function(data){
					//window.location.href = "reports/report_1.html";
					window.open("reports/report_1.html");
				}
		})
	});
	$('#load-report-2').click(function(){
		var group_id=$('select#report-sample-list option:selected').attr('value');
		$.ajax({
			url:"../reports/report2.php",
			type:"GET",
			success:function(data){
					//window.location.href = "reports/report_2.html";
					window.open("reports/report_2.html");
				}
		})
	});
})