<script setup lang="ts">
import AppSidebar from '@/components/AppSidebar.vue';
import { Separator } from '@/components/ui/separator';
import {
    SidebarInset,
    SidebarProvider,
    SidebarTrigger,
} from '@/components/ui/sidebar';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
    <SidebarProvider :default-open="page.props.sidebarOpen">
        <AppSidebar />
        <SidebarInset>
            <header
                class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12"
            >
                <div class="flex items-center gap-2 px-4">
                    <SidebarTrigger class="-ml-1" />
                    <Separator
                        orientation="vertical"
                        class="mr-2 data-[orientation=vertical]:h-4"
                    />
                    <h1 class="text-sm font-medium">Panel de control</h1>
                </div>
            </header>
            <main class="w-full">
                <slot />
            </main>
        </SidebarInset>
    </SidebarProvider>
</template>
