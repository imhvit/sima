<script setup lang="ts">
import Section from '@/components/Section.vue';
import StatsCard from '@/components/StatsCard.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import {
    AlertTriangle,
    Building2,
    Download,
    Package,
    Plus,
    Wallet,
} from '@lucide/vue';

defineProps<{
    totalProducts: number;
    totalWarehouses: number;
    totalInventoryValue: string;
}>();

const formatCurrency = (value: string) => {
    return new Intl.NumberFormat('es-PE', {
        style: 'currency',
        currency: 'PEN',
    }).format(Number(value));
};
</script>

<template>
    <AppLayout module="Panel de control">
        <Section class="mb-4 flex justify-end">
            <div class="flex items-center gap-x-2">
                <Button variant="secondary">
                    <Download />
                    Exportar
                </Button>
                <Button>
                    <Plus />
                    Nueva orden
                </Button>
            </div>
        </Section>
        <Section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <StatsCard
                title="Total de productos"
                :value="totalProducts"
                description="Sin cambios"
                :icon="Package"
            />
            <StatsCard
                title="Almacenes"
                :value="totalWarehouses"
                description="Sin cambios"
                :icon="Building2"
            />
            <StatsCard
                title="Valor total del stock"
                :value="formatCurrency(totalInventoryValue)"
                description="Sin cambios"
                :icon="Wallet"
            />
            <StatsCard
                title="Alertas de stock bajo"
                value="0"
                description="Sin cambios"
                :icon="AlertTriangle"
                variant="destructive"
            />
        </Section>
    </AppLayout>
</template>
