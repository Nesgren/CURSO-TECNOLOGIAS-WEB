@if(session('pending_invitation'))
    <div class="modal fade" id="invitationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invitación Pendiente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Has sido invitado a unirte al área {{ session('pending_invitation')->area->name }} en la empresa {{ session('pending_invitation')->company->name }}.</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('employee.accept-invitation', session('pending_invitation')) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </form>
                    <form action="{{ route('employee.reject-invitation', session('pending_invitation')) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Rechazar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#invitationModal').modal('show');
        });
    </script>
@endif