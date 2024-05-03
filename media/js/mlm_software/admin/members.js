var reportMemTable = "";
$(document).ready(function () {
  let searchObj = {};
  var target = $("#target").val();
  reportMemTable = {
    printTable: function (search_data) {
      getpaginate(
        search_data,
        "#member_list",
        target,
        "Only For Id, Name & Mobile Number."
      );
    },
  };
  reportMemTable.printTable(searchObj);

  $("#member_list").on("click", ".getAction", function () {
    let actNbtn = $(this).attr("data-id");
    let actnstr = actNbtn.split("-");
    let base_url = $("#base_url").val() + actnstr[1];
    if (actnstr[0] == "del_member") {
      $.post(
        base_url,
        { id: actnstr[2], actnMng: "del_member" },
        function (getResponse) {
          $("#cnfDel_id").val(getResponse.action);
          $(".delMsg").html(getResponse.title);
          $(".actnData").html(getResponse.text);
        },
        "json"
      );
    }
  });

  $("#deleteCnfrMtn").click(function () {
    let actnstr = isCheck("cnfDel_id").split("-");
    let base_url = $("#base_url").val() + actnstr[1];

    if (actnstr[0] == "confirm_delete") {
      $.post(
        base_url,
        { id: actnstr[2], actnMng: actnstr[0] },
        function (getResponse) {
          if (getResponse.adClass == "tst_success") {
            $(".actnData").html(getResponse.text).css("color", "#02a30c");
            setTimeout(function () {
              window.location.reload(1);
            }, 2000);
          } else if (getResponse.adClass == "tst_success") {
            $(".actnData").html(getResponse.text).css("color", "#c99a00");
          } else {
            $(".actnData")
              .html(getResponse.text)
              .$(".actnData")
              .html("")
              .css("color", "#a30225");
          }
        },
        "json"
      );
    } else if (actnstr[0] == "memberDoc") {
      $.post(
        base_url,
        { actn: isCheck("memberId"), docType: actnstr[2] },
        function (htmlAmi) {
          if (htmlAmi.icon == "1") {
            $(".actnData").html(htmlAmi.text);
            $(".actnData").css("color", "#219C07");
            $("#deleteModel").delay(3000).modal("hide");
          } else {
            $(".actnData").html(htmlAmi.text);
            $(".actnData").css("color", "#D10303");
          }
          if (actnstr[2] == "delAadhar") {
            $("#adrImg").attr("src", isCheck("base_url") + htmlAmi.img_loc);
          } else if (actnstr[2] == "delPan") {
            $("#panImg").attr("src", isCheck("base_url") + htmlAmi.img_loc);
          } else if (actnstr[2] == "delBankpass") {
            $("#passBookImg").attr(
              "src",
              isCheck("base_url") + htmlAmi.img_loc
            );
          }
          $("#deleteCnfrMtn")
            .html('Confirm Delete <i class="bx bx-trash"></i>')
            .removeClass("btn-outline-success")
            .addClass("btn-outline-danger");
          /*setTimeout(function(){window.location.reload(1);},1500);*/
        },
        "json"
      );
    }
  });

  // $(".memSelectR")
  //   .unbind("change")
  //   .change(function () {
  //     var actNbtn = $(this).attr("id");
  //     if (actNbtn == "gender") {
  //       let fmPackage = isCheck("fmPackage").split("@@@@");
  //       if (isCheck("gender") != "Female") {
  //         $("#package option[value='" + fmPackage[0] + "']").remove();
  //       } else {
  //         if (
  //           $("#package").find('option[value="' + fmPackage[0] + '"]')
  //             .length === 0
  //         ) {
  //           $("#package").append(
  //             '<option value="' +
  //               fmPackage[0] +
  //               '">' +
  //               fmPackage[1] +
  //               "</option>"
  //           );
  //         }
  //       }
  //     }
  //   });

  $(".memAction")
    .unbind("click")
    .click(function () {
      let getId = $(this).attr("id");
     
      if (getId == "getNext") {
        if (isCheck("miAction") == "1") {
          $.post(
            isCheck("target"),
            {
              dob: isCheck("date_of_birth"),
              salutation: isCheck("salutation"),
              mem_code: isCheck("mem_code"),
              mem_name: isCheck("mem_name"),
              gender: isCheck("gender"),
              mob_nu: isCheck("mob_nu"),
              emailId: isCheck("emailId"),
              password: isCheck("password"),
              confPass: isCheck("confPass"),
              package: isCheck("package"),
              sponsorId: isCheck("sponsorId"),
              package: isCheck("package"),
              miAction: isCheck("miAction"),
            },
            function (htmlAmi) {
              toastMultiShow(htmlAmi.adClass, htmlAmi.msg, htmlAmi.icon);
              if (htmlAmi.adClass == "tst_success") {
                $("#miAction").val(htmlAmi.actn);
                $("#memberId").val(htmlAmi.memId);
                $("#personalInfo").hide();
                $("#communicationInfo,#getPrevious").show();
                $("#commDet").addClass("cmpltVzrd");
              }
            },
            "json"
          );
        } else if (isCheck("miAction") == "2") {
          $.post(
            isCheck("target"),
            {
              address: isCheck("address"),
              statN: isCheck("statN"),
              district: isCheck("district"),
              zipcode: isCheck("zipcode"),
              pan_no: isCheck("pan_no"),
              aadhaar_no: isCheck("aadhaar_no"),
              memberId: isCheck("memberId"),
              miAction: isCheck("miAction"),
            },
            function (htmlAmi) {
              toastMultiShow(htmlAmi.adClass, htmlAmi.msg, htmlAmi.icon);
              if (htmlAmi.adClass == "tst_success") {
                $("#personalInfo,#communicationInfo,#docInfo").hide();
                $("#getPrevious,#bankingInfo").show();
                $("#miAction").val(htmlAmi.actn);
                $("#bnkDet").addClass("cmpltVzrd");
              }
            },
            "json"
          );
        } else if (isCheck("miAction") == "3") {
          $.post(
            isCheck("target"),
            {
              bName: isCheck("bName"),
              bankAc: isCheck("bankAc"),
              bnkIFSC: isCheck("bnkIFSC"),
              brName: isCheck("brName"),
              nomiName: isCheck("nomiName"),
              nomineeRel: isCheck("nomineeRel"),
              NomAddr: isCheck("NomAddr"),
              miAction: isCheck("miAction"),
              memberId: isCheck("memberId"),
            },
            function (htmlAmi) {
              toastMultiShow(htmlAmi.adClass, htmlAmi.msg, htmlAmi.icon);
              if (htmlAmi.adClass == "tst_success") {
                $("#personalInfo,#bankingInfo").hide();
                $("#getPrevious,#docInfo").show();
                $("#miAction").val(htmlAmi.actn);
                $("#docDet").addClass("cmpltVzrd");
                $("#getNext").html('<i class="bx bx-save"></i> Save');
              }
            },
            "json"
          );
        } else if (isCheck("miAction") == "4") {
          setTimeout(function () {
            window.location.reload(1);
          }, 1500);
        }
      } else if (getId == "getPrevious") {
        if (isCheck("miAction") == "2") {
          $("#getPrevious,#communicationInfo,#bankingInfo").hide();
          $("#personalInfo").show();
          $("#miAction").val("1");
          $("#commDet").removeClass("cmpltVzrd");
        } else if (isCheck("miAction") == "3") {
          $("#personalInfo,#bankingInfo,#docInfo").hide();
          $("#getPrevious,#communicationInfo").show();
          $("#miAction").val("2");
          $("#bnkDet").removeClass("cmpltVzrd");
        } else if (isCheck("miAction") == "4") {
          $("#personalInfo,#docInfo,#communicationInfo").hide();
          $("#getPrevious,#bankingInfo,#getNext").show();
          $("#miAction").val("3");
          $("#docDet").removeClass("cmpltVzrd");
          $("#getNext").html('Next <i class="fas fa-arrow-right "></i>');
        }
      }
    });
  $(".memActn")
    .unbind("click")
    .click(function () {
      //https://botfiller.com/

      let actNbtn = $(this).attr("data-id");
      let actnstr = actNbtn.split("-");
      $(".actnData").css("color", "#f56e50");
      if (actnstr[2] == "profileImg") {
        $("#cnfDel_id").val(actNbtn);
        $(".delMsg").html('<i class="bx bx-trash"></i> Delete Profile Image');
        $(".actnData").html("Are you want to delete profile image");
      } else if (actnstr[2] == "delAadhar") {
        $("#cnfDel_id").val(actNbtn);
        $(".delMsg").html(
          '<i class="bx bx-trash"></i> Delete Aadhaar Document'
        );
        $(".actnData").html("Are you want to delete aadhaar document");
      } else if (actnstr[2] == "delPan") {
        $("#cnfDel_id").val(actNbtn);
        $(".delMsg").html('<i class="bx bx-trash"></i> Delete Pan Document');
        $(".actnData").html("Are you want to delete pan document");
      } else if (actnstr[2] == "delBankpass") {
        $("#cnfDel_id").val(actNbtn);
        $(".delMsg").html(
          '<i class="bx bx-trash"></i> Delete Passbook Document'
        );
        $(".actnData").html("Are you want to delete passbook document");
      } else if (actnstr[0] == "midoc") {
        $("#memDocFileUpload").toggle();
        $("html,body").animate(
          { scrollTop: $("#memDocFileUpload").offset().top },
          "slow"
        );
        $("#docUrlActn").html(actNbtn);
      }
    });
  $(".memberImgUploadActn")
    .unbind("click")
    .click(function () {
      var imgFile = $("#docfile").val();
      if (imgFile == "") {
        toast("tst_danger", "Please select profile image");
      } else {
        var name = document.getElementById("docfile").files[0].name;
        var form_data = new FormData();
        var ext = name.split(".").pop().toLowerCase();
        if (jQuery.inArray(ext, ["gif", "png", "jpg", "jpeg"]) == -1) {
          toast("tst_danger", "Please provide valid image format");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("docfile").files[0]);
        var f = document.getElementById("docfile").files[0];
        var fsize = f.size || f.fileSize;
        if (fsize > 2000000) {
          toast("tst_danger", "Image File Size is very big");
        } else {
          let docUrlActn = $("#docUrlActn").text();
          let target = docUrlActn.split("-");
          let isCheckUrl = isCheck("base_url") + target[2];
          form_data.append("file", document.getElementById("docfile").files[0]);
          form_data.append("memberId", isCheck("memberId"));
          form_data.append("miAction", isCheck("miAction"));
          form_data.append("docType", target[1]);
          $.ajax({
            url: isCheckUrl,
            method: "POST",
            data: form_data,
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
              $("#Update")
                .html('<i class="bx bx-cog bx-spin"></i> Wait....')
                .css("padding", "6px 13.2px 6px 16.5px");
            },
            success: function (data) {
              $("#Update")
                .css("padding", "6px 10px 6px 16.7px")
                .html('<i class="bx bx-save"></i> Upload');
              toastMultiShow(data.adClass, data.msg, data.icon);
              $("#docfile").val("");
              if (target[1] == "profileImg") {
                $("#profileImg").attr(
                  "src",
                  isCheck("base_url") + data.img_loc
                );
              } else if (target[1] == "edtAadhar") {
                $("#adrImg").attr("src", isCheck("base_url") + data.img_loc);
              } else if (target[1] == "pancard") {
                $("#panImg").attr("src", isCheck("base_url") + data.img_loc);
              } else if (target[1] == "passbook") {
                $("#passBookImg").attr(
                  "src",
                  isCheck("base_url") + data.img_loc
                );
              }
            },
          });
        }
      }
    });
  $(".partAction")
    .unbind("keyup")
    .keyup(function () {
      let getId = $(this).attr("id");
      if (getId == "sponsorId") {
        let isCheckUrl =
          isCheck("base_url") + "mlm_software/admin/member/isExistSponsor";
        $.post(
          isCheckUrl,
          { sponsorId: isCheck("sponsorId") },
          function (getData) {
            $("#sponsorName").html(getData.spName);
            $("#spErr").css("color", getData.err).html(getData.msg);
          },
          "json"
        );
      }
    });

  $(".empSelectR")
    .unbind("change")
    .change(function () {
      var actNbtn = $(this).attr("id");
      if (actNbtn == "statN") {
        let isCheckUrl =
          isCheck("base_url") + "mlm_software/admin/member/cityList";
        $("#district").html("<option>Please Wait.....</option>");
        $("#district").css("color", "#00917C");
        $.post(isCheckUrl, { id: $("#" + actNbtn).val() }, function (htmlAmi) {
          $("#district").html(htmlAmi);
          $("#district").css("color", "#4d545b");
        });
      }
    });

  $(".downami")
    .unbind("click")
    .click(function () {
      let getId = $(this).attr("id");
      $.post(isCheck("target"), { id: getId }, function (htmlAmi) {
        let noTree = $("#nTree" + getId).text();
        if (noTree == "1") {
          toast(
            "tst_warning",
            "There is no downline available inside this member"
          );
        }
        $("#miAr" + getId).html(htmlAmi);
      });
    });

  $(".ActnCmdByAmi").click(function () {
    var actNbtn = $(this).attr("id");
   
    if (actNbtn == "miActivate") {
      if (!isCheck("pack_plan")) {
        $("#userIdAErr")
          .html('<i class="bx bx-cog bx-spin"></i> Please select package plan')
          .show()
          .addClass("ami_danger")
          .removeClass("ami_warning ami_success");
      } else if (!isCheck("userIdA")) {
        $("#userIdAErr")
          .html(
            '<i class="bx bx-cog bx-spin"></i> Please Input User Id/Frenchisee Id whom to activate account '
          )
          .show()
          .addClass("ami_danger")
          .removeClass("ami_warning ami_success");
      } else {
        /*else if(isNaN(isCheck('userIdA'))){$('#userIdAErr').html('<i class="bx bx-cog bx-spin"></i> Please Input Valid User Id/Frenchisee Id whom to activate account').show().addClass('ami_warning').removeClass('ami_danger ami_success');
			}*/
        $.post(
          isCheckUrlMsdrAdmn("member/isActivateMember"),
          {
            userIdA: isCheck("userIdA"),
            pack_plan: isCheck("pack_plan"),
            amiActn: "arvtpchk",
          },
          function (htmlAmi) {
            if (htmlAmi.data == "2") {
              $("#userIdAErr")
                .html(htmlAmi.text)
                .show()
                .addClass("ami_warning")
                .removeClass("ami_danger ami_success");
            } else {
              $("#userIdAErr")
                .html(
                  '<i class="bx bx-smile"></i> Thank you! we have got member details'
                )
                .show()
                .addClass("ami_success")
                .removeClass("ami_danger ami_warning")
                .delay(1000)
                .fadeOut();
              $("#dGather").show();
              $("#mId").html(htmlAmi.username);
              $("#mname").html(htmlAmi.name);
              $("#mobile").html(htmlAmi.mobile);
              $("#eml").html(htmlAmi.email);
              $("#packPr").html(htmlAmi.pack_price);
              $("#miActivate").hide();
              $("#mitopUp").show();
            }
          },
          "json"
        );
      }
    } else if (actNbtn == "mitopUp") {
      $.post(
        isCheckUrlMsdrAdmn("member/isActivateMember"),
        {
          userIdA: isCheck("userIdA"),
          pack_plan: isCheck("pack_plan"),
          amiActn: "arvtpdne",
        },
        function (htmlAmi) {
          if (htmlAmi.data == "2") {
            $("#userIdAErr")
              .html(htmlAmi.text)
              .show()
              .addClass("ami_warning")
              .removeClass("ami_danger ami_success");
            $("#dGather").hide();
            $("#miFire").hide();
            $("#miActivate").show();
            $("#mitopUp").hide();
          } else {
            /*	else if(htmlAmi.data=='3')
			{   $('#userIdAErr').addClass('ami_success').removeClass('ami_danger ami_warning').html(htmlAmi.text).show();$('#dGather').hide();$('#miFire').hide();
				$('#miActivate').show();$('#mitopUp').hide();
				}*/
            $("#userIdAErr")
              .addClass("ami_success")
              .removeClass("ami_danger ami_warning")
              .html(htmlAmi.text)
              .show();
            $("#miFire").show().delay(3000).fadeOut();
            setTimeout(function () {
              window.location.reload(1);
            }, 3200);
          }
        },
        "json"
      );
    }
  });
});

function create(getId) {
  $.post(isCheck("target"), { id: getId }, function (htmlAmi) {
    let noTree = $("#nTree" + getId).text();
    if (noTree == "1") {
      toast("tst_warning", "There is no downline available inside this member");
    }
    $("#" + getId).html(htmlAmi);
  });
}

function visiblePass(str) {
  var shw = '<div class="passwrd"></div>';
  /* let target = $('#target').val();
 let base_url = target.substring(0,48);
 let imgUrl= target.substring(0,22);*/
  let target = $("#base_url").val();
  $.ajax({
    url: target + "mlm_software/admin/member/passv",
    type: "POST",
    data: { pID: str },
    beforeSend: function () {
      $("#vsblPass").html(
        '<img src="' +
          target +
          'media/images/loader.gif" style="height:10px;" >'
      );
    },
    success: function (data) {
      $("#vsblPass").css("color", "rgb(87, 87, 87)").html(data);
      setTimeout(function () {
        $("#vsblPass").html(shw).css("color", "#d50000");
      }, 5000);
    },
  });
}

function toastMultiShow(adCls, msg, icon) {
  let valid = "";
  let myClass = "tst_success tst_warning tst_danger";
  let restCls = myClass.replace(adCls, " ");
  let addonMsg = "";
  $.each(msg, function (i, item) {
    valid += "<li>" + item + "</li>";
  });
  $(".tst_danger").addClass("ts_dan");
  $(".tst_warning").addClass("ts_war");
  if (adCls == "tst_success") {
    addonMsg = icon + " <ul>" + valid + "</ul>";
  } else if (adCls == "tst_danger") {
    addonMsg = icon + " <ul>" + valid + "</ul>";
  } else if (adCls == "tst_warning") {
    addonMsg = icon + " <ul>" + valid + "</ul>";
  }
  $(".ami_toast")
    .css("visibility", "visible")
    .html(addonMsg)
    .addClass(adCls)
    .removeClass(restCls);
  setTimeout(function () {
    $(".ami_toast").css("visibility", "hidden");
  }, 2000);
}
