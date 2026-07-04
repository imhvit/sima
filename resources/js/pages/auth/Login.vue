<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { GoogleIcon } from '@/icons';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const isFormValid = computed(() => {
    return !!(form.email?.trim() && form.password?.trim());
});

const handleLogin = () => {
    if (form.processing) return;

    if (!form.email?.trim() || !form.password?.trim()) return;

    form.email = form.email?.trim();
    form.password = form.password?.trim();

    form.post('/auth/login', {
        onFinish: () => {
            form.reset('password');
        }
    })
}
</script>

<template>

    <Head title="Iniciar sesión" description="Bienvenido a Sima, por favor completa los campos" />
    <AuthLayout title="Acceder a Sima" description="Bienvenido a Sima, por favor completa los campos">
        <div class="flex flex-col gap-y-4">
            <Button variant="ghost" disabled>
                <GoogleIcon class="size-4" />
                Iniciar sesión con Google
            </Button>
        </div>
        <div class="flex items-center my-4">
            <span class="flex-1 h-px bg-border"></span>
            <span class="px-2 text-muted-foreground">o</span>
            <span class="flex-1 h-px bg-border"></span>
        </div>
        <form @submit.prevent="handleLogin" class="space-y-4">
            <div class="grid items-center w-full max-w-sm gap-1.5">
                <Label for="email">Correo electrónico</Label>
                <Input id="email" v-model="form.email" :disabled="form.processing" type="email"
                    placeholder="example@example.com" />
                <span v-if="form.errors.email" class="text-xs text-destructive">{{ form.errors.email }}</span>
            </div>
            <div class="grid items-center w-full max-w-sm gap-1.5">
                <Label for="password">Contraseña</Label>
                <Input id="password" v-model="form.password" :disabled="form.processing" type="password"
                    placeholder="••••••••" minlength="8" autocomplete="current-password" />
            </div>
            <div class="flex items-center gap-x-2">
                <Checkbox id="remember" v-model="form.remember" />
                <Label for="remember">Recordar sesión</Label>
            </div>
            <Button type="submit" :disabled="!isFormValid || form.processing" class="w-full">
                <Spinner class="absolute" :class="{ 'opacity-100': form.processing, 'opacity-0': !form.processing }" />
                <span :class="{ 'opacity-0': form.processing, 'opacity-100': !form.processing }">Continuar</span>
            </Button>
        </form>
    </AuthLayout>
</template>