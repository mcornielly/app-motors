@extends('main')

@section('container')
	<template v-if="menu==0">
		<h1>       Dashboard</h1>
	</template>
	<template v-if="menu==1">
		<clients-component></clients-component>
	</template>
	<template v-if="menu==2">
		<h1>       Direcciones</h1>
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
	<template v-if="menu==9">
		<h1>       Opción 9</h1>
	</template>
	<template v-if="menu==10">
		<h1>       Opción 10</h1>
	</template>
@endsection