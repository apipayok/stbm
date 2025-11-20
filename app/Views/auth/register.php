<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex">

    <div class="w-2/4 bg-gray-100 flex justify-center items-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-96">
            <h3 class="text-2xl font-semibold text-center mb-6">Daftar</h3>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('/register') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>

                <div>
                    <label for="staffno" class="block mb-1 font-medium text-gray-700">No. Staff</label>
                    <input type="text" id="staffno" name="staffno" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <div>
                    <label for="username" class="block mb-1 font-medium text-gray-700">Nama Pengguna</label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="password" class="block mb-1 font-medium text-gray-700">Kata Laluan</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition duration-200">Register</button>
            </form>

            <div class="mt-4 text-center text-black text-sm">
        Sudah berdaftar? <a href="<?= base_url('/login') ?>" class="text-black font-semibold hover:underline">Log Masuk</a>
      </div>
        </div>
    </div>

    <div class="w-3/5 bg-green-600 flex justify-center items-center text-white">
        
    </div>

</body>

</html>