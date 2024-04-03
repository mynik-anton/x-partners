document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("real_estates_image").addEventListener("change", function (e) {
    var fileName = e.target.files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
  });

  jQuery("#add_real_estate_form").submit(function (e) {
    e.preventDefault();
    let form = this;
    var formData = new FormData(this);
    formData.append("action", "add_real_estate");

    jQuery(".page-loader").fadeIn().css("display", "flex");
    jQuery.ajax({
      type: "POST",
      url: ajaxurl,
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        let responseObject = JSON.parse(response);
        console.log(responseObject);
        jQuery(form).trigger("reset");
        jQuery(form).find(".custom-file-label").text("Выбрать изображение");
        jQuery(".page-loader").fadeOut();
        jQuery("#successMessage").modal("show");
      },
      error: function (xhr, status, error) {
        console.error(error);
        jQuery(".page-loader").fadeOut();
      },
    });
  });
});
