<!-- List -->
<div class="mx-auto px-4 sm:px-8 py-8 overflow-x-auto">
    <div class="inline-block min-w-full rounded-md">
        <table class="min-w-full leading-normal">
            <thead>
                {{ $thead }}
            </thead>
            <tbody>
                {{ $tbody }}
            </tbody>
        </table>

        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
            {{ $pagination }}
        </div>
    </div>

</div>
