<script setup lang="ts" generic="T extends Record<string, any>">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Sheet,
    SheetClose,
    SheetContent,
    SheetDescription,
    SheetFooter,
    SheetHeader,
    SheetTitle,
} from '@/components/ui/sheet';
import { DetailField } from '@/types';
import Spinner from '../ui/spinner/Spinner.vue';

const props = defineProps<{
    title: string;
    description: string;
    data: T | null;
    fields: DetailField<T>[];
    isLoading?: boolean;
}>();

const getFieldValue = (field: DetailField<T>) => {
    if (!props.data) return '—';

    const value = props.data[field.key];

    if (value === null || value === undefined) return '—';

    return field.formatter ? field.formatter(value) : value;
};
</script>

<template>
    <Sheet>
        <SheetContent>
            <SheetHeader>
                <SheetTitle>{{ title }}</SheetTitle>
                <SheetDescription>
                    {{ description }}
                </SheetDescription>
            </SheetHeader>
            <div
                v-if="isLoading"
                class="flex h-full flex-col items-center justify-center space-y-4"
            >
                <Spinner class="size-8" />
                <p class="animate-pulse text-sm text-muted-foreground">
                    Cargando detalles...
                </p>
            </div>
            <div
                v-else-if="data"
                class="grid flex-1 auto-rows-min gap-6 overflow-y-auto px-4"
            >
                <template v-for="field in fields" :key="field.key">
                    <div class="group relative grid gap-3">
                        <Label :for="`sheet-details-${String(field.key)}`">{{
                            field.label
                        }}</Label>
                        <div
                            v-if="
                                field.key === 'image' &&
                                data[field.key] !== null
                            "
                            class="invisible absolute right-0 bottom-full z-50 size-30 scale-95 rounded-4xl p-2 opacity-0 shadow-xl transition-all duration-300 group-hover:visible group-hover:scale-100 group-hover:bg-border group-hover:opacity-100"
                        >
                            <img
                                :src="`${getFieldValue(field)}`"
                                :alt="field.label"
                                class="size-full rounded-3xl object-cover"
                            />
                        </div>
                        <Input
                            :id="`sheet-details-${String(field.key)}`"
                            :default-value="`${getFieldValue(field)}`"
                            type="text"
                            readonly
                        />
                    </div>
                </template>
            </div>
            <div
                v-else
                class="flex h-40 items-center justify-center text-sm text-muted-foreground"
            >
                Sin resultados.
            </div>
            <SheetFooter>
                <SheetClose as-child>
                    <Button>Cerrar</Button>
                </SheetClose>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
