@extends('main')

@section('container')
    @if(Auth::check())
        @if(Auth::user()->role_id == 1)
            	<template v-if="menu==0">
					<h1>       Dashboard</h1>
				</template>
				<template v-if="menu==1">
					<clients-component></clients-component>
				</template>
				<template v-if="menu==2">
					<addresses-component></addresses-component>
				</template>
				<template v-if="menu==3">
					<h1>       Ordenes</h1>
				</template>
				<template v-if="menu==4">
					<h1>       Opción 4</h1>
				</template>
				<template v-if="menu==5">
					<h1>       Opción 5</h1>
				</template>
				<template v-if="menu==6">
					<h1>       Opción 6</h1>
				</template>
				<template v-if="menu==7">
					<h1>       Opción 7</h1>
				</template>
				<template v-if="menu==8">
					<h1>       Opción 8</h1>
				</template>
				<template v-if="menu==11">
					<users-component></users-component>
				</template>
				<template v-if="menu==12">
					<roles-component></roles-component>
				</template>
        @else(Auth::user()->role_id == 2)
                <template v-if="menu==0">
					<h1>       Dashboard</h1>
				</template>
				<template v-if="menu==1">
					<clients-component></clients-component>
				</template>
				<template v-if="menu==2">
					<addresses-component></addresses-component>
				</template>
				<template v-if="menu==3">
					<h1>       Ordenes</h1>
				</template>
				<template v-if="menu==4">
					<h1>       Opción 4</h1>
				</template>
				<template v-if="menu==5">
					<h1>       Opción 5</h1>
				</template>
				<template v-if="menu==6">
					<h1>       Opción 6</h1>
				</template>
				<template v-if="menu==7">
					<h1>       Opción 7</h1>
				</template>
				<template v-if="menu==8">
					<h1>       Opción 8</h1>
				</template>
        @endif
    @endif

@endsection