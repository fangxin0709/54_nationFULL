function del(table,id){
    $.post("./api/del.php",{table,id},()=>{
        location.reload();
    })
}
function delF(table,id){
    $.post("./api/delF.php",{table,id},()=>{
        location.reload();
    })
}
function edit(table,id){
    switch(table){
        case "bus":
            $(".modal.e1").fadeIn();
            $.getJSON("./api/get.php",{table,id},(data)=>{
                $("#edit_busId").val(data.id);
                $("#edit_busName").text(data.busName);
                $("#edit_busMin").val(data.minute);
            })
            break;
        case "station":
            $(".modal.e2").fadeIn();
            $.getJSON("./api/get.php",{table,id},(data)=>{
                $("#edit_stationId").val(data.id);
                $("#edit_stationName").text(data.stationName);
                $("#edit_waiting").val(data.waiting);
                $("#edit_stationMin").val(data.minute);
            })
            break;
        case "form":
            $(".modal.e3").fadeIn();
            $.getJSON("./api/get.php",{table,id},(data)=>{
                $("#edit_formId").val(data.id);
                $("#edit_email").text(data.email);
                $("#edit_name").val(data.name);
            })
            break;
    }
}
function setT(tableId) {
    $(`#${tableId} tbody`).sortable({
        helper: function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width()); // 記錄寬度
            });
            return ui;
        },
        placeholder: 'ui-state-highlight',
        update: function() {
            let arr = $(`#${tableId} tbody tr`).map(function() {
                return $(this).data('id');
            }).get();
            $.post('./api/edit_rank.php', { table: tableId, arr: arr });
        }
    }).disableSelection();
}