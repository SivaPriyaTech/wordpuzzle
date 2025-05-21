<div class="card shadow mt-5">
    <div class="card-header bg-primary text-white text-center">
    <h4>🎓 Student Registration</h4>
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('register.student') }}">
        @csrf

        <!-- Student Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your full name">
        </div>

        <!-- Email ID -->
        <div class="mb-3">
            <label for="email" class="form-label">Email ID <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
        </div>

        <button type="submit" class="btn btn-success w-100">Start Puzzle Game</button>
    </form>
    </div>
</div>