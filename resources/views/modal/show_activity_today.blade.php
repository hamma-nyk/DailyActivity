<div class="modal fade" id="modalShow{{ $activity_today->id  }}" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail your activity</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('activity_management.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input hidden readonly type="text" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    <input hidden readonly type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                    <input hidden readonly type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input readonly type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ $activity_today->tanggal }}">
                    </div>
                    @error('tanggal')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="activity" class="form-label">Aktivitas kamu</label>
                        <textarea readonly type="text" class="form-control" id="activity" name="activity"
                            placeholder="..." style="min-height: 100px; height: 300px">{{ $activity_today->activity }}</textarea>
                    </div>
                    @error('activity')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button class="btn btn-primary" type="submit">Add</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>