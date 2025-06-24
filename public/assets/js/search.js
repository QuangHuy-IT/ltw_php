$(function () {
  // Xác thực Bootstrap
  (() => {
    "use strict";
    const form = $("#searchForm");
    form.on("submit", function (e) {
      e.preventDefault();
      if (this.checkValidity() === false) {
        e.stopPropagation();
        $(this).addClass("was-validated");
        return;
      }
      lookup($("#license").val().trim());
    });
  })();

  function lookup(plate) {
    $.ajax({
      url: "ajax/search_vehicle.php",
      method: "GET",
      data: { license_plate: plate },
      dataType: "json",
      beforeSend: () => {
        $('#spinner').removeClass('d-none');
        $("#resultCard").addClass("d-none");
      },
      success: (res) => {
        if (!res.success) {
          showResult(`<div class="alert alert-warning">${res.message}</div>`);
          return;
        }
        const v = res.data.vehicle;
        const violations = res.data.violations;
        let html = `
          <h5>Thông tin phương tiện</h5>
          <table class="table table-sm">
            <tr><th>Biển số</th><td>${v.license_plate}</td></tr>
            <tr><th>Loại</th><td>${v.vehicle_type}</td></tr>
            <tr><th>Hãng / Model</th><td>${v.brand} ${v.model ?? ""}</td></tr>
            <tr><th>Màu</th><td>${v.color ?? ""}</td></tr>
          </table>
          <h5 class="mt-4">Lịch sử vi phạm</h5>`;
        if (violations.length === 0) {
          html += `<p class="text-success">Không có vi phạm.</p>`;
        } else {
          html += `<div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>Ngày</th><th>Mô tả</th><th>Số tiền</th><th>Trạng thái</th>
                </tr>
              </thead><tbody>`;
          violations.forEach((vio) => {
            html += `
              <tr>
                <td>${vio.violation_date}</td>
                <td>${vio.description}</td>
                <td>${Number(vio.fine_amount).toLocaleString()} ₫</td>
                <td><span class="badge bg-${
                  vio.payment_status === "đã nộp" ? "success" : "danger"
                }">
                       ${
                         vio.payment_status === "đã nộp"
                           ? "Đã nộp phạt"
                           : "Chưa nộp"
                       }
                    </span></td>
              </tr>`;
          });
          html += `</tbody></table></div>`;
        }
        showResult(html);
      },
      error: () =>
        showResult(
          '<div class="alert alert-danger">Có lỗi khi tra cứu. Vui lòng thử lại.</div>'
        ),
    });
  }

  function showResult(html) {
    $("#resultBody").html(html);
    $("#resultCard").removeClass("d-none");
  }
});
