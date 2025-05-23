$(function () {
  loadTable();
});

function loadTable() {
  $.get('ajax/list_vehicles.php', res => {
    const tbody = $('#tblVehicles tbody').empty();
    res.forEach(v => {
      tbody.append(`
        <tr>
          <td>${v.vehicle_id}</td>
          <td>${v.owner_name ?? ''}</td>
          <td>${v.license_plate}</td>
          <td>${v.vehicle_type}</td>
          <td>${v.brand}</td>
          <td>${v.color ?? ''}</td>
          <td>
            <button class="btn btn-sm btn-warning me-1" onclick="openForm(${v.vehicle_id})">Sửa</button>
            <button class="btn btn-sm btn-danger" onclick="del(${v.vehicle_id})">Xoá</button>
          </td>
        </tr>
      `);
    });
  }, 'json');
}

function openForm(id = 0) {
  $('#modalTitle').text(id ? 'Cập nhật phương tiện' : 'Thêm phương tiện');
  $('#modalBody').load(`form.php?id=${id}`, () => {
    new bootstrap.Modal('#vehicleModal').show();
  });
}

function del(id) {
  if (!confirm('Xoá phương tiện?')) return;
  $.post('ajax/delete_vehicle.php', { id }, res => {
    if (res.success) loadTable(); else alert(res.message);
  }, 'json');
}
