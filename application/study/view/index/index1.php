{layout name="index\layout" /}
<h2>用户列表（{$list->total()}）</h2>
{volist name="list" id="user"}
<div class="info">
    ID：{$user.id}<br/>
    昵称：{$user.nickname}<br/>
    姓名：{$user.name}<br/>
</div>
{/volist}
{$list->render()}