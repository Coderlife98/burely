var repUnitManage = "";
var repCatManage = "";
var repPackageManage = "";
var reportOrdTable = "";
var repStockManage = "";
var repStockProductWise = "";
var repShopeeManage = "";
var repSaleManage = "";
var repLedgerTable = "";
var repMemEarningTable = "";
var repWallTnxTable = "";

/*================Member side start===================*/
var reportChildTable = "";
/*================Member side End===================*/

$(document).ready(function () {
  $("input").keyup(function () {
    $("#getMsgSuccess").fadeOut("slow");
  });
});

function validate(id, target) {
  //alert(id+target);
  $(id).submit(function (e) {
    e.preventDefault();
    let base_url = $("#base_url").val() + "mlm_software/" + target;

    $.ajax({
      url: base_url,
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (data) {
        popup(data);
      },
    });
  });
}

function popup(data) {
  if (data.icon == "error") {
    var valid = "";
    $.each(data.text, function (i, item) {
      valid += item;
    });
    Swal.fire({
      position: "top-end",
      icon: data.icon,
      html: valid,
      showConfirmButton: !1,
      timer: 1500,
    });
  } else {
    Swal.fire({
      position: "top-end",
      icon: data.icon,
      title: data.text,
      showConfirmButton: !1,
      timer: 1500,
    });
    setTimeout(function () {
      window.location.reload(1);
    }, 1500);
  }
}

function flashMsg(dIcon, msg) {
  Swal.fire({
    position: "top-end",
    icon: dIcon,
    title: msg,
    showConfirmButton: !1,
    timer: 1500,
  });
}
function isCheck(str) {
  var inputBx = $("#" + str).val();
  if (inputBx == "") {
    return "";
  } else {
    return inputBx;
  }
}
function flashHtml(id, data) {
  $(id).html(data);
}
function flashMsgFrCurd(str, idElemnt) {
  $(idElemnt).fadeIn();
  if (str == "1") {
    $(idElemnt).addClass("alertSuccess");
    $(idElemnt).removeClass("alertWarning");
    $(idElemnt).removeClass("alertDanger");
    $(idElemnt).html(
      '<i class="bx bx-wink-smile"></i> You have successfully updated your record'
    );
  } else if (str == "2") {
    $(idElemnt).addClass("alertWarning");
    $(idElemnt).removeClass("alertSuccess");
    $(idElemnt).removeClass("alertDanger");
    $(idElemnt).html(
      "<i class='bx bx-confused'></i> Ooop's something get wrong while updatting your record"
    );
  }
}
function flashsweet(data) {
  if (data.icon == "error") {
    var valid = "";
    $.each(data.text, function (i, item) {
      valid += item;
    });
    Swal.fire({
      position: "top-end",
      icon: data.icon,
      html: valid,
      showConfirmButton: !1,
      timer: 1500,
    });
  } else {
    Swal.fire({
      position: "top-end",
      icon: data.icon,
      title: data.text,
      showConfirmButton: !1,
      timer: 1500,
    });
    /*   setTimeout(function () { window.location.reload(1); }, 1500);*/
  }
}
function getpaginate(search_data, id, page, plchldr) {
  //id,page,placehldr
  var base_url = $("#base_url").val(); //"responsive": true,
  $(id).DataTable({
    processing: true,
    serverSide: true,
    order: [],
    bDestroy: true,
    columnDefs: [{ targets: [1, 2, 3], orderable: true }],
    ajax: {
      url: base_url + page,
      type: "POST",
      dataSrc: "data",
      data: search_data,
    },
    language: { searchPlaceholder: plchldr },
    // dom: 'Bfrtip',
    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    buttons: [] /*"excel", "pdf", "print"*/,
  });
}
function get_search(tbactn, frmId, tbstorage) {
  $(frmId).submit(function (e) {
    e.preventDefault();
    $(tbstorage).DataTable().clear().destroy();
    let search = $(frmId).serializeArray();
    let searchObj = {};
    $.each(search, function (i, row) {
      searchObj[row.name] = row.value;
    });
    tbactn.printTable(searchObj);
    $("html,body").animate({ scrollTop: $(tbstorage).offset().top }, "slow");
  });
}
function isCheckUrl(page) {
  return isCheck("base_url") + "super_admin/mlm_software/" + page;
}
function isCheckUrlAdmn(page) {
  return isCheck("base_url") + "super_admin/" + page;
}

function setSelect(id, val) {
  $(id + " option").each(function () {
    if ($(this).val() == val) {
      $(this).prop("selected", true);
    }
  });
}
function flash_msg_class(id, msg, adCls) {
  let myClass = "ami_warning ami_success ami_danger";
  let restCls = myClass.replace(adCls, " ");
  $(id).html(msg).fadeIn("slow").addClass(adCls).removeClass(restCls);
}
function gethtmlTools(str, val) {
  return (
    '<input type="text" id="' + str + '" class="edtBltxt" value="' + val + '">'
  );
}
function toast(adCls, msg) {
  let myClass = "tst_success tst_warning tst_danger";
  let restCls = myClass.replace(adCls, " ");
  let addonMsg = "";
  if (adCls == "tst_success") {
    addonMsg = '<i class="bx bx-check"></i> ' + msg;
  } else if (adCls == "tst_danger") {
    addonMsg = '<i class="bx bx-x"></i> ' + msg;
  } else if (adCls == "tst_warning") {
    addonMsg = '<i class="bx bx-error"></i> ' + msg;
  } else if (adCls == "tst_default") {
    addonMsg = '<i class="bx bx-cog bx-spin"></i> ' + msg;
  }
  $(".ami_toast")
    .css("visibility", "visible")
    .html(addonMsg)
    .addClass(adCls)
    .removeClass(restCls);
  setTimeout(function () {
    $(".ami_toast").css("visibility", "hidden");
  }, 2000);
  /*/storage/emulated/0/media/recovery*/
}
function point(id) {
  return $("#" + id).focus();
}

function isCheckUrlMsdrAdmn(page) {
  return isCheck("base_url") + "mlm_software/admin/" + page;
}

function pStatus(str) {
  let target = isCheck("miTarget");
  $("#ms" + str).html('<i class="bx bx-cog bx-spin"></i> Wait...');
  $.post(
    target,
    { str: str },
    function (htmlAmi) {
      let myClass = "bg-olive bg-orange";
      let restCls = myClass.replace(htmlAmi.btnCls, " ");
      $("#ms" + str)
        .html(htmlAmi.btnText)
        .addClass(htmlAmi.btnCls)
        .removeClass(restCls);
      toast(htmlAmi.adCls, htmlAmi.text);
    },
    "json"
  );
}
