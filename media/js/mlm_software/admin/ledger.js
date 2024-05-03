
	
var repMlmInc='';

$(document).ready(function() 
{
	let base_url=$('#base_url').val();
	let actnMinUrl=$('#actnMinUrl').val();
	let target=$('#target').val();
let searchObj = {};
repLedgerTable = {printTable:function(search_data){getpaginate(search_data,'#ledger_table','mlm_software/admin/ledger/ledger_data','Tnx Id');}}
repLedgerTable.printTable(searchObj);

repMemEarningTable = {printTable:function(search_data){getpaginate(search_data,'#view_earning','mlm_software/admin/income/earning_data','Tnx Id');}}
repMemEarningTable.printTable(searchObj);

repSaleManage = {printTable:function (search_data){getpaginate(search_data, '#my_sale_list', target, 'Only For Id,Product Name.');}}
repSaleManage.printTable(searchObj);



/* repMlmInc = {printTable:function(search_data){getpaginate(search_data,'#mi_mlm_inc',actnMinUrl,'Tnx Id');}}
 repMlmInc.printTable(searchObj);*/

$(".ActnCmdByAmi").click(function()
	{
		let getId=$(this).attr('id');
		if(getId=='saleCnfrm')
		{
			if(!isCheck('ordSts')){toast('tst_danger','Please choose order option'); point('ordSts');}
			else
			{   let adCls="";let rmvCls="";let isCheckUrl=isCheck('base_url')+$('#getTargetForFrenchise').html();
				if(isCheck('ordSts')=='Delivered'){ adCls="delevered";rmvCls="miCancel";}else{rmvCls="delevered";adCls="miCancel";}
				$('#orderStsDisply').html(isCheck('ordSts')).addClass(adCls).removeClass(rmvCls);
				$.post(isCheckUrl,{ordSts:isCheck('ordSts'),orderID:isCheck('orderID')},function(htmlAmi){
				
				   toast(htmlAmi.adClass,htmlAmi.text);
				/*if(htmlAmi.adClass='tst_success'){setTimeout(function(){window.location.href=htmlAmi.targetUrl;},1500);}*/
				
				},'json');
					
					}
			
			}

		});

/*	$(".ActnCmdByAmi").click(function()
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
	});
	$(".mi_spr").click(function(){let actNbtn=$(this).attr('id');let base_url=$('#base_url').val();setInterval(function(){window.location=base_url+'income/'+actNbtn;},100);});*/
});


