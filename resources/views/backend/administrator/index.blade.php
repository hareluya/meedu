@extends('layouts.backend')

@section('body')

    @include('components.breadcrumb', ['name' => '管理员列表'])

    <el-row>
        <el-col :span="24">
            @include('components.button', ['url' => route('backend.administrator.create'), 'title' => '添加'])
        </el-col>
        <el-col :span="24">
            <el-table :data="administrators" style="width: 100%">
                <el-table-column
                        prop="name"
                        label="姓名">
                </el-table-column>
                <el-table-column
                        prop="email"
                        label="邮箱">
                </el-table-column>
                <el-table-column
                        prop="last_login_ip"
                        label="最后登录">
                    @verbatim
                    <template slot-scope="scope">
                        {{scope.row.last_login_date}}/{{scope.row.last_login_ip}}
                    </template>
                    @endverbatim
                </el-table-column>
                <el-table-column
                        prop="created_at"
                        label="创建时间">
                </el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <el-button
                                size="mini"
                                @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
    </el-row>

@endsection

@section('js')
    <script>
        Vue.mixin({
            data: function () {
                return {
                    remoteData: @json($administrators),
                }
            },
            computed: {
                administrators: function () {
                    var administrators = this.remoteData.data;
                    return administrators;
                }
            },
            methods: {
                handleEdit: function (index, admin) {
                    location.href = admin.edit_url;
                },
                handleDelete: function (index, admin) {
                    location.href = admin.destroy_url;
                },
            }
        });
    </script>
@endsection