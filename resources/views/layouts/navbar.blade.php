<div class="bg-white shadow p-4 flex justify-between">

    <h1 class="text-2xl font-bold">

        Dashboard

    </h1>

    <div class="flex items-center gap-3">

        <div class="text-right">

            <p class="font-bold">
                {{ auth()->user()->name }}
            </p>

            <p class="text-sm text-gray-500">
                {{ auth()->user()->role }}
            </p>

        </div>

    </div>

</div>