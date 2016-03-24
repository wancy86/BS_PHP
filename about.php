<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/bs.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="images/bs.ico" type="image/x-icon" />
    <title>About</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--navbar-->
                <?php require_once 'header.php';?>
            </div>
        </div>
        <div class="col-md-6">
            <pre>
            <h3>二期</h3>
            <b>架构设计：</b>
            1.淘宝客平台的接入
                获取订单信息
                给会员返还积分

            2.会员中心的设计实现
                用户订单/积分/邀请/佣金

            3.宝贝搜索功能的实现
                高级智能分词搜索

            4.站内统计分析
                销量报表
                热门宝贝排行
                用户喜好分析，智能推荐

            5.移动端的开发
                极大的可能需要原生APP的开发
                接入支付宝和淘宝手机端

            6.可能的转型：
                1.返利网站，
                    在淘宝客中心注入脚本自定完成数据导入
                    需要淘宝付费接口跟踪订单
                    记录用户点击匹配 商品号和订单号完成订单跟踪
                2.简单的导购网站
                3.内容网站，男人时尚,财经，生意

            7.其他平台的接入
                京东
                蘑菇街
                1号店...

            <b>任务列表：</b>
            ★★☆优先完成:
            OK 研究如何接入淘宝客API,订单跟踪绕行★
                用户中心需要订单号录入关联功能,查询返利
                根据用户购买记录关联宝贝列表返还积分
                不在需要什么狗屁的A接口了
                FUCK, 都TMD的没有接口跟踪订单，怎么玩

            <a href="http://open.taobao.com/doc2/detail.htm?articleId=1014&docType=1&treeId=null">淘宝客API使用场景介绍</a>
            宝贝展示的美化，收益/用户返利
            TODO 返利比例和收入比例管理
            目前订单订单关联有漏洞，如何验证真实性
                OK 点击访问历史，如果没有访问过必然没有购买过，pro_id, date

            如何实现数据的自动采集
            如何实现订单数据的自动同步

            登录页面的完善
            注册页面的完善

            OK 收藏列表
            OK 收藏表设计
            OK 添加收藏、取消收藏
            OK 有时间研究下popover插件，显示问题,用button就OK

            引入JS模板引擎,对比后选择腾讯的atrtemplate, 然并卵
            添加移除收藏无刷新完善
            已收藏过的宝贝展示页面显示已收藏
            提示消息不使用alert

            TODO uptotop icon fix.

            搜索功能
            多个功能的分页功能
            软文推广功能
            JSON文件不再全部列出来，按需加载
                类别-编码-最大记录数，还是直接使用分页？

            数据管理页面需要添加成交订单导入
                用户点击记录,暂且不做，智能推荐
                OK 设计订单表
                OK 订单显示页面
                OK 用户订单查询页面,添加订单，删除订单
                订单页面的验证数据刷新完善
                分页功能的实现

            JSON数据列表需要分页
            OK 导航菜单组成二级的
            OK 菜单自动弹出

            OK 重新整理分类,数据导入优化
            OK 图片的大小不一样想办法调整: 指定高度
            OK 利用shuffle()对展示类表洗牌换序
            OK admin_add 页面改成tab的方式

            从about等其他页面到index的跳转bug，cookie(上线不显示他们)
            注册用户需要淘宝账号
            用户中心展示礼品兑换目标

            </pre>
        </div>
        <div class="row">
            <div class="col-md-6">
                <pre>
                <h3>一期已完成</h3>
                <b>架构设计：</b>
                    1.数据存储：
                      使用数据库存储宝贝信息，定期生成乱序的json文件，在浏览器端缓存
                    2.数据加载：
                      使用异步的json文件加载显示
                      滚动刷新加载
                    3.后台管理页面：
                      表格的方式显示当前的宝贝记录，支持删除操作，排序, 隐藏
                      可以添加新的宝贝
                    4.推广模式
                      实现传销推广模式，层级提成
                    5.返利方式
                      BB的方式返利
                      前期使用兑换和支付购买的方式消费BB
                      后期实现提现

                <b>任务列表：</b>
                    OK 数据导入功能完成,之后可以完成数据的显示 <a href="http://jingyan.baidu.com/article/cd4c2979138007756e6e60fd.html">Demo</a>
                    OK 后台数据管理优先完成，现生产后消费
                    OK 完成页面的整合，根据参数显示信息

                    OK 登陆注册页面的添加
                    OK 添加登录注册按钮

                    OK 验证码的添加
                    OK 用户表的设计
                    OK 注册实现
                    OK 登录实现
                    OK 数据管理页面添加功能实现

                    数据库设计
                    用户收藏的管理
                    积分功能实现
                    管理员对宝贝的删除 - index页面混合

                    OK JS加载数据
                    OK tab改为js事件
                    OK 滚动加载
                    OK 从JSON读取数据，$.getJSON(url,callBack)


                    OK JSON文件表的生成设计实现:
                    OK 第一次加载一页数据，48条
                    OK 以后每个文件加载100条数据
                    OK 根据数据条数自动生成文件
                    OK 全部使用JSON文件的方式加载数据

                    OK 实现分页和滚动刷新
                    OK 实现json数据的缓存
                    OK 添加按钮滚动到顶部
                    OK 站长统计连接的接入


                </pre>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
        <!--footer-->
        <?php require_once 'footer.php';?>
    </div>
    <?php require_once 'script.php';?>
</body>

</html>
