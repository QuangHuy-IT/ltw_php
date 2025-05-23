<?php
require_once __DIR__.'/../inc/auth.php'; requireLogin();
$title='Vi phạm'; include __DIR__.'/../inc/header.php';
?>
<h1 class="mb-3">Vi phạm</h1>
<button class="btn btn-primary mb-3" onclick="openVio()">+ Thêm</button>
<table id="tblVio" class="table table-bordered align-middle">
  <thead class="table-light">
    <tr>
      <th>ID</th><th>Biển số</th><th>Ngày</th><th>Mô tả</th><th>Phạt (₫)</th>
      <th>TT thanh toán</th><th width="120">Hành động</th>
    </tr>
  </thead><tbody></tbody>
</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(loadVio);
function loadVio(){
  $.get('ajax/list_violations.php',d=>{
    const tb=$('#tblVio tbody').empty();
    d.forEach(v=>{
      tb.append(`<tr>
        <td>${v.violation_id}</td><td>${v.license_plate}</td><td>${v.violation_date}</td>
        <td>${v.description}</td><td>${Number(v.fine_amount).toLocaleString()}</td>
        <td><span class="badge bg-${v.payment_status==='paid'?'success':'danger'}">${v.payment_status}</span></td>
        <td>
          <button class="btn btn-sm btn-warning me-1" onclick="editVio(${v.violation_id})">Sửa</button>
          <button class="btn btn-sm btn-info" onclick="togglePay(${v.violation_id},'${v.payment_status}')">Đổi TT</button>
        </td>
      </tr>`);
    });
  },'json');
}

function editVio(id){
  const desc=prompt('Nhập mô tả vi phạm mới:');
  if(desc===null)return;
  const fine=prompt('Nhập số tiền phạt:');
  if(fine===null)return;
  $.post('ajax/update_violation.php',{id,description:desc,fine},r=>{
    if(r.success)loadVio();else alert(r.message);
  },'json');
}

function togglePay(id,status){
  const next=status==='paid'?'unpaid':'paid';
  if(!confirm(`Chuyển trạng thái thành ${next}?`))return;
  $.post('ajax/update_payment.php',{id,status:next},r=>{
    if(r.success)loadVio();else alert(r.message);
  },'json');
}
</script>
<!-- Modal Vi phạm -->
<div class="modal fade" id="vioModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="vioTitle"></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body" id="vioBody"></div>
  </div></div>
</div>
<script>
function openVio(id=0){
  $('#vioTitle').text(id?'Cập nhật vi phạm':'Thêm vi phạm');
  $('#vioBody').load(`form.php?id=${id}`, ()=> new bootstrap.Modal('#vioModal').show());
}
</script>

<?php include __DIR__.'/../inc/footer.php'; ?>
