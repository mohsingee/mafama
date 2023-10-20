@extends('layouts.main') 
@section("content")

<section>
    <div class="container">
        <div class="row">
            <!-- tabs content -->
            <div class="col-md-12 col-sm-12">
                <div class="col-md-12">
                    <div class="heading-title heading-dotted col-md-12 margin-bottom-20 text-center">
                        <h4>Settings / Create Revenue Account</h4>
                    </div>
                    <div class="col-md-12 text-right margin-bottom-20">
                        <?php if($chat != "off"){ ?>
                            <a href="{{ url('chat') }}" class="btn btn-md btn-info margin-right-10">Chat</a>
                        <?php } ?>
                        <?php if($tools != "off"){ ?>
                            <a href="{{ url('tools') }}" class="btn btn-md btn-info margin-right-10">Tools</a>
                        <?php } ?>
                        <a href="{{ url('calender_meeting') }}" class="btn btn-md btn-info margin-right-10">Calender meetings / tasks</a>
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-info">Back</a>
                    </div>
                    <ul class="nav nav-tabs nav-button-tabs nav-justified margin-bottom-40">
                        <li class="active"><a href="{{ url('create_revenue_account') }}">Create Revenue Account</a></li>
                        <li><a href="{{ url('create_expenses_account') }}">Create Expense Account</a></li>
                        <li><a href="{{ url('invoice_setup') }}">Invoice Setup</a></li>
                        <li><a href="#">Balance Sheet</a></li>
                        <li><a href="{{ url('templates') }}">Choose a template</a></li>
                    </ul>

                    <div class="tab-content margin-top-10" style="border: 1px solid #da291c !important; border-radius: 10px; padding: 10px;">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                                <thead>
                                    <tr>
                                        <th>List of accounts</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Test</td>
                                        <td>12-07-2020</td>
                                        <td>200</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-success edit">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td>Test1</td>
                                        <td>12-07-2020</td>
                                        <td>200</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-success edit">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td>Test2</td>
                                        <td>12-07-2020</td>
                                        <td>200</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-success edit">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td>Test3</td>
                                        <td>12-07-2020</td>
                                        <td>200</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-success edit">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td>Test4</td>
                                        <td>12-07-2020</td>
                                        <td>200</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-success edit">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <tr>
                                        <td>Test</td>
                                        <td>12-07-2020</td>
                                        <td>200</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-success edit">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-xs btn-info delete">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function initTable7() {
        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $(">td", nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $(">td", nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<a class="edit btn btn-xs btn-info" href="">Save</a><a class="cancel btn btn-xs btn-info" href="">Cancel</a>';
            jqTds[4].innerHTML = "";
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $("input", nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $("input", nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
            oTable.fnDraw();
        }

        var table = $("#sample_editable_1");

        var oTable = table.dataTable({
            lengthMenu: [
                [5, 15, 20, -1],
                [5, 15, 20, "All"], // change per page values here
            ],
            // set the initial value
            pageLength: 10,

            language: {
                lengthMenu: " _MENU_ records",
            },
            columnDefs: [
                {
                    // set default column settings
                    orderable: true,
                    targets: [0],
                },
                {
                    searchable: true,
                    targets: [0],
                },
            ],
            order: [[0, "asc"]], // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false, //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $("#sample_editable_1_new").click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;
                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            var aiNew = oTable.fnAddData(["", "", "", "", "", ""]);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on("click", ".delete", function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents("tr")[0];
            oTable.fnDeleteRow(nRow);
            alert("Deleted! Do not forget to do some ajax to sync with backend :)");
        });

        table.on("click", ".cancel", function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on("click", ".edit", function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents("tr")[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    // Table Init
    initTable7();
</script>


@endsection