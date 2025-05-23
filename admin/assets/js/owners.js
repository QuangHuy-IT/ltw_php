$(loadOwners);

function loadOwners(){
  $.get('ajax/list_owners.php', data=>{
    const tb=$('#tblOwners tbody').empty();
    data.forEach(o=>{
      tb.append(`<tr>
       <td>${o.owner_id}</td><td>${o.full_name}</td><td>${o.id_number}</td>
       <td>${o.phone??''}</td><td>${o.address??''}</td>
       <td>
         <button class="btn btn-sm btn-warning me-1" onclick="openOwner(${o.owner_id})">Sửa</button>
         <button class="btn btn-sm btn-success me-1" onclick="addVehicle(${o.owner_id})">Xe</button>
         <button class="btn btn-sm btn-danger" onclick="delOwner(${o.owner_id})">Xóa</button>

       </td>
      </tr>`);
    });
  },'json');
}

function openOwner(id=0){
  $('#ownerTitle').text(id?'Cập nhật chủ sở hữu':'Thêm chủ sở hữu');
  $('#ownerBody').load(`form.php?id=${id}`,()=>new bootstrap.Modal('#ownerModal').show());
}

function delOwner(id){
  if(!confirm('Xóa chủ sở hữu?'))return;
  $.post('ajax/delete_owner.php',{id},r=>{
    if(r.success)loadOwners();else alert(r.message);
  },'json');
}

function addVehicle(ownerId){
  const tpl = id => `<button class="btn flex-grow-1 mb-2 w-100" id="${id}"></button>`;
  $('#ownerTitle').text('Quản lý phương tiện');
  $('#ownerBody').html(
      tpl('btnOwned') + tpl('btnLink') + tpl('btnNew') +
      `<div id="vehicleContent"></div>`
  );
  // đặt nhãn + màu
  $('#btnOwned').addClass('btn-info').text('Xe sở hữu');
  $('#btnLink') .addClass('btn-success').text('Gán xe chưa có chủ');
  $('#btnNew')  .addClass('btn-primary').text('Thêm xe mới');

  const mdl = new bootstrap.Modal('#ownerModal'); mdl.show();

  $('#btnOwned').on('click', () =>
    $('#vehicleContent').load(`vehicle_owned.php?owner_id=${ownerId}`)
  );
  $('#btnLink').on('click', () =>
    $('#vehicleContent').load(`vehicle_select.php?owner_id=${ownerId}`)
  );
  $('#btnNew').on('click',  () =>
    $('#vehicleContent').load(`../vehicles/form.php?owner_id=${ownerId}`)
  );
}
