@extends('layout.default')
@section('title', $contest->title)

@section('content')
        @include('share._error')


        @cannot('check_permission',$contest)
            <form action="{{ route('contests.add_user_by_password',$contest->id) }}" method="post">
                {{ csrf_field() }}
                密码：<input type="password" name="password" id="password">
                <button type="submit">提交</button>
            </form>
        @else
        Contest show!
        @endcan
@stop


