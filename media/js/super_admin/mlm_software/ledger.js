function getpaginate(search_data,id,page,plchldr)
{	 
    var base_url=$('#base_url').val();	
	$(id).DataTable({"responsive": true,"processing": true,"serverSide": true,"order": [],'columnDefs': [{'targets': [1, 2, 3, 4,5],'orderable': true}],
                "ajax":{"url": base_url+page,"type": "POST", "dataSrc": "data","data": search_data},
                language:{searchPlaceholder:plchldr},
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "buttons": ["excel", "pdf", "print"]
            });
}
	
var repMlmInc='';
var repdepoMng='';

$(document).ready(function() 
{
	let base_url=$('#base_url').val();
	let actnMinUrl=$('#actnMinUrl').val();
	
	let target=$('#target').val();
	
	
let searchObj = {};
let reportTable = {printTable:function(search_data){getpaginate(search_data,'#ledger_table','super_admin/mlm_software/ledger/ledger_data','Tnx Id');}}
reportTable.printTable(searchObj);
 repMlmInc = {printTable:function(search_data){getpaginate(search_data,'#mi_mlm_inc',actnMinUrl,'Tnx Id');}}
 repMlmInc.printTable(searchObj);

 repdepoMng = {printTable:function(search_data){getpaginate(search_data,'#depo_transaction',target,'Tnx Id ,Amount');}}
 repdepoMng.printTable(searchObj);




$('#search').submit(function (e) {
		e.preventDefault();
		$("#ledger_table").DataTable().clear().destroy();
		let search = $('#search').serializeArray();
		let searchObj = {};
		$.each(search, function (i, row) {searchObj[row.name] = row.value;});
		reportTable.printTable(searchObj);
		$('html,body').animate({ scrollTop: $("#ledger_table").offset().top},'slow');
});


	$(".form-control").keyup(function()
	{
	   var actNbtn=$(this).attr('id');
	   $('.ami_danger').fadeOut('slow'); $('.ami_warning').fadeOut('slow');
		});
	$(".empSelectR").change(function()
	{ 
		$('.ami_danger').fadeOut('slow'); 
		$('.ami_warning').fadeOut('slow');
		 var actNbtn=$(this).attr('id');
		if(actNbtn=='trfType')
		{
			$.post(isCheck('target'),
				   {trfType:isCheck('trfType'),getMemID:isCheck('getMemID')},
				   function(htmlAmi)
				   {$('#tnxActnID').html(htmlAmi).removeClass('form-control').css('height','50px');});
			}
	
	});


	$(".ActnCmdByAmi").click(function()
	{	
	 	var actNbtn=$(this).attr('id');
		 if(actNbtn=='miActivate')
		{
			if(!isCheck('pack_plan')){$('#userIdAErr').html('<i class="bx bx-cog bx-spin"></i> Please select package plan').show().addClass('ami_danger').removeClass('ami_warning ami_success');}
			else if(!isCheck('userIdA')){$('#userIdAErr').html('<i class="bx bx-cog bx-spin"></i> Please Input User Id/Frenchisee Id whom to activate account ').show().addClass('ami_danger').removeClass('ami_warning ami_success');}
			else if(isNaN(isCheck('userIdA'))){$('#userIdAErr').html('<i class="bx bx-cog bx-spin"></i> Please Input Valid User Id/Frenchisee Id whom to activate account').show().addClass('ami_warning').removeClass('ami_danger ami_success');
			}
			else
			{
				 $.post(isCheckUrl('super_admin/mlm_software/member/isTopupMember'),{userIdA:isCheck('userIdA'),pack_plan:isCheck('pack_plan'),amiActn:'arvtpchk'},
		        function(htmlAmi){
					if(htmlAmi.data=='2'){	$('#userIdAErr').html(htmlAmi.text).show().addClass('ami_warning').removeClass('ami_danger ami_success');}
					else{	
						  $('#userIdAErr').html('<i class="bx bx-smile"></i> Thank you! we have got member details').show().addClass('ami_success').removeClass('ami_danger ami_warning').delay(1000).fadeOut();
						  $('#dGather').show();$('#mId').html(htmlAmi.username);$('#mname').html(htmlAmi.name); $('#mobile').html(htmlAmi.mobile);
						  $('#eml').html(htmlAmi.email);$('#packPr').html(isCheck('pack_plan'));$('#miActivate').hide();$('#mitopUp').show();
						  }
				},"json");		
			}
		}
		else if(actNbtn=='mitopUp')
		{
			$.post(isCheckUrl('super_admin/mlm_software/member/isTopupMember'),{userIdA:isCheck('userIdA'),pack_plan:isCheck('pack_plan'),amiActn:'arvtpdne'},
		    function(htmlAmi){
			if(htmlAmi.data=='2'){	
								$('#userIdAErr').html(htmlAmi.text).show().addClass('ami_warning').removeClass('ami_danger ami_success');
								$('#dGather').hide();$('#miFire').hide();$('#miActivate').show();$('#mitopUp').hide();
								}
			else{ 
					$('#userIdAErr').html(htmlAmi.text).show().addClass('ami_success').removeClass('ami_danger ami_warning').delay(1000).fadeOut();
					$('#miFire').show().delay(3000).fadeOut();setTimeout(function(){window.location.reload(1);},3200);
					}
							},'json');
			}
		else if(actNbtn=='depActivate')
		{
			
			if(!isCheck('trAction')){getPopup('error','Please select transaction type');}
			else if(!isCheck('trfType')){getPopup('error','Please select transfer type');}
			else if(!isCheck('admnTnxID')){getPopup('error','Please input transaction id');}
			else if(!isCheck('tnxRemarksByAdmin')){getPopup('error','Please input remarks.');}
			else
			{	
					let target=isCheck('target').split('_');
					let isUrl=target[0]+'_'+target[1]+'_'+target[2];
			        $.post(isUrl,{trAction:isCheck('trAction'),trfType:isCheck('trfType'),getMemID:isCheck('getMemID'),admnTnxID:isCheck('admnTnxID'),tnxRemarksByAdmin:isCheck('tnxRemarksByAdmin'),depoID:isCheck('depoID')},function(htmlAmi)
					{if(htmlAmi.result=='1'){getPopup('success',htmlAmi.msg);setTimeout(function(){window.location.reload(1);},2000);}else{getPopup('error',htmlAmi.msg);}},'json');
				}
			
			
			
			}
	});
	$(".mi_spr").click(function(){let actNbtn=$(this).attr('id');let base_url=$('#base_url').val();setInterval(function(){window.location=base_url+'income/'+actNbtn;},100);});
});

function get_search(tbactn,frmId,tbstorage)
{$(frmId).submit(function (e){e.preventDefault(); $(tbstorage).DataTable().clear().destroy();let search = $(frmId).serializeArray();let searchObj={};
$.each(search,function (i,row){searchObj[row.name]=row.value;});tbactn.printTable(searchObj);$('html,body').animate({scrollTop:$(tbstorage).offset().top},'slow');});}

function isCheckUrl(page){return isCheck('base_url')+page;}
function isCheck(str){var inputBx=$('#'+str).val();if(inputBx==""){return "";}else{return inputBx;}}

function getPopup(icn,msg){Swal.fire({position:"top-end",icon:icn,title:msg,showConfirmButton:!1,timer: 1500});}





