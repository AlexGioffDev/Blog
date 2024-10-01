<template>
    <header class="w-full p-5 border-b-[0.5px] border-b-gray-100">
        <a href="/">Byte Bistro</a>
    </header>
    <main class="max-w-7xl mx-auto mt-8">
        <slot />
    </main>

    <footer class="fixed bottom-0 w-full">
        <p>&copy; {{ new Date().getFullYear() }} Byte Bistro</p>
    </footer>
</template>
