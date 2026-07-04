<script setup lang="ts">
import type { SidebarProps } from '@/components/ui/sidebar';

import { Boxes } from '@lucide/vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';

import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarRail,
} from '@/components/ui/sidebar';
import { useAuth } from '@/composables/useAuth';
import { NAV_MAIN } from '@/consts/sidebar';

const props = withDefaults(defineProps<SidebarProps>(), {
    collapsible: 'icon',
});

const { user } = useAuth();
const data = {
    user: {
        name: user.value.name,
        email: user.value.email,
        avatar: 'https://avatars.githubusercontent.com/u/161224634?v=4',
    },
    navMain: NAV_MAIN,
};
</script>

<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <div>
                            <div
                                class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground"
                            >
                                <Boxes class="size-4" />
                            </div>
                            <div class="flex flex-col gap-0.5 leading-none">
                                <span class="font-medium">SIMA</span>
                                <span class="text-xs"
                                    >Gestión de Inventario</span
                                >
                            </div>
                        </div>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>
        <SidebarContent>
            <NavMain :items="data.navMain" />
        </SidebarContent>
        <SidebarFooter>
            <NavUser :user="data.user" />
        </SidebarFooter>
        <SidebarRail />
    </Sidebar>
</template>
