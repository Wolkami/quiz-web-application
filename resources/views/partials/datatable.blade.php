@if($elements_type)
    @php($route_path = "admin.{$elements_type}.mass_destroy")
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let deleteButtonTrans = '{{ config('constants.util.delete_selected_button_text') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route($route_path) }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    let ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });
                    if (ids.length === 0) {
                        alert('{{ config('constants.util.alert_no_selected_elements_text') }}')
                        return
                    }
                    if (confirm('{{ config('constants.util.confirm_delete_elements_text') }}')) {
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'asc']],
                pageLength: 50,
            });
            $('.{{ $datatable_selector }}:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endif
