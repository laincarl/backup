# -*- coding: utf-8 -*-

import flask_admin
import flask_login
from flask import Flask, url_for, redirect, render_template, request
from flask_admin import helpers, expose
from flask_admin.contrib import sqla
from flask_babelex import Babel
from flask_sqlalchemy import SQLAlchemy
from markupsafe import Markup
from werkzeug.security import check_password_hash
from wtforms import form, fields, validators


# Create Flask application
app = Flask(__name__)
babel = Babel(app)   # 转化为中文
app.config.from_pyfile('config.py')
db = SQLAlchemy(app)


class tbladmin(db.Model):
    ADID = db.Column(db.Integer, primary_key=True)
    ADUserName = db.Column(db.String(30), unique=True)
    ADPassword = db.Column(db.String(128))

    # Flask-Login integration
    def is_authenticated(self):
        return True

    def is_active(self):
        return True

    def is_anonymous(self):
        return False

    def get_id(self):
        return self.ADID

    # Required for administrative interface
    def __unicode__(self):
        return self.ADUserName


# 用户管理
class tbluser(db.Model):
    UID = db.Column(db.Integer, primary_key=True)
    UEmail = db.Column(db.String(200))
    UQQ_openid = db.Column(db.String(100), default=u'无')
    UState = db.Column(db.Boolean())
    URegTime = db.Column(db.TIMESTAMP)
    UIdentity = db.Column(db.String(30))

    def __unicode__(self):
        return self.UEmail


# 求职者管理
class tblemployeeinfo(db.Model):
    EIID = db.Column(db.Integer, primary_key=True)
    EI_fk_UID = db.Column(db.String(200))
    EIName = db.Column(db.String(200))
    EIBirthday = db.Column(db.String(200))
    EISex = db.Column(db.String(200))
    EIHeadPic = db.Column(db.String(200))
    EIAddress = db.Column(db.String(200))
    EITopEdu = db.Column(db.String(200))
    EIGraduateYear = db.Column(db.String(200))
    EIGraduateSchool = db.Column(db.String(200))
    EIProfession = db.Column(db.String(200))
    EIPhoneNum = db.Column(db.String(200))
    EIResume = db.Column(db.String(200))
    EIOrder_City = db.Column(db.String(200))
    EIOrder_Position = db.Column(db.String(200))

    def __unicode__(self):
        return self.EIID


# 公司管理
class tblcompanyinfo(db.Model):
    CIID = db.Column(db.Integer, primary_key=True)
    CI_fk_UID = db.Column(db.String(200))
    CIName = db.Column(db.String(200))
    CIOtherName = db.Column(db.String(200))
    CILogo = db.Column(db.String(200))
    CIIndustry = db.Column(db.String(200))
    CIProperty = db.Column(db.String(200))
    CIScale = db.Column(db.String(200))
    CIBLR_num = db.Column(db.String(200))
    CIBLR_pic = db.Column(db.String(200))
    CIIntro = db.Column(db.String(200))
    CILinkName = db.Column(db.String(200))
    CILinkPhone = db.Column(db.String(200))
    CIWebsite = db.Column(db.String(200))
    CIWelfare = db.Column(db.String(200))
    CIEnvirPics = db.Column(db.String(200))
    CIProCityAddress = db.Column(db.String(200))
    CISpecificAddress = db.Column(db.String(200))
    CILongitude = db.Column(db.String(200))
    CILatitude = db.Column(db.String(200))
    CIState = db.Column(db.Boolean())
    def __unicode__(self):
        return self.CIID


# 职位管理
class tblpositioninfo(db.Model):
    PIID = db.Column(db.Integer, primary_key=True)
    PI_fk_CIID = db.Column(db.String(200))
    PIName = db.Column(db.String(200))
    PIClass = db.Column(db.String(200))
    PIDuty = db.Column(db.String(200))
    PIQualification = db.Column(db.String(200))
    PIWelfare = db.Column(db.String(200))
    PIWage = db.Column(db.String(200))
    PILowEdu = db.Column(db.String(200))
    PIPacticeorFull = db.Column(db.String(200))
    PIWorkPlace = db.Column(db.String(200))
    PINeedNum = db.Column(db.String(200))
    PIExperience = db.Column(db.String(200))
    PIRegTime = db.Column(db.String(200))
    PIEndTime = db.Column(db.String(200))

    def __unicode__(self):
        return self.PIID


# 公司动态管理
class tblcompanydynamic(db.Model):
    CDID = db.Column(db.Integer, primary_key=True)
    CDContent = db.Column(db.String(200))
    CDTime = db.Column(db.String(200))
    CD_fk_CIID = db.Column(db.String(200))

    def __unicode__(self):
        return self.CDID




# 校园招聘管理
class tblcampusemployer(db.Model):
    CEID = db.Column(db.Integer, primary_key=True)
    CEName = db.Column(db.String(200))
    CELogo = db.Column(db.String(200))
    CECity = db.Column(db.String(200))
    CETimeStart = db.Column(db.String(200))
    CETimeEnd = db.Column(db.DATE)
    CECompanyUrl = db.Column(db.DATE)

    def __unicode__(self):
        return self.CEID

# 登录表单 (for flask-login)
class LoginForm(form.Form):
    username = fields.StringField(u"用户名", validators=[validators.DataRequired(message=u'用户名不能为空！')])
    password = fields.PasswordField(u"密码", validators=[validators.DataRequired(message=u'密码不能为空！')])

    def validate_username(self, field):
        admin = self.get_user()

        if admin is None:
            raise validators.ValidationError(u'管理员不存在！')

        if not check_password_hash(admin.ADPassword, self.password.data):
            raise validators.ValidationError(u'密码错误！')

    def get_user(self):
        return db.session.query(tbladmin).filter_by(ADUserName=self.username.data).first()


# 初始化flask-login
def init_login():
    login_manager = flask_login.LoginManager()
    login_manager.init_app(app)

    # Create user loader function
    @login_manager.user_loader
    def load_user(user_id):
        return db.session.query(tbladmin).get(user_id)


# 创建常规模型视图类
class tbluserModelView(sqla.ModelView):

    def is_accessible(self):
        return flask_login.current_user.is_authenticated

    can_create = False   # 不能创建
    can_delete = False   # 不能删除
    can_edit = False   # 不能编辑
    column_labels = {
        'UEmail': u'用户邮箱',
        'UQQ_openid': u'QQ接入认证ID',
        'UState': u'激活状态',
        'URegTime': u'注册时间',
        'UIdentity': u'用户身份'
    }
    column_list = ('UEmail', 'UQQ_openid', 'UState', 'URegTime', 'UIdentity')
    column_searchable_list = ('UEmail', 'UQQ_openid', 'UState', 'URegTime', 'UIdentity')
    column_filters = ('UEmail', 'UQQ_openid', 'UState', 'URegTime', 'UIdentity')

    def __init__(self, session, **kwargs):
        super(tbluserModelView, self).__init__(tbluser, session, **kwargs)


class tblemployeeinfoModelView(sqla.ModelView):

    def is_accessible(self):
        return flask_login.current_user.is_authenticated

    can_create = False

    # list_template = 'mylist.html'
    can_view_details = True
    can_delete = False  # 不能删除
    can_edit = False  # 不能编辑
    # can_export = True   # 导出
    column_labels = {
        'EIName': u'姓名',
        'EIBirthday': u'生日',
        'EISex': u'性别',
        'EIHeadPic': u'头像',
        'EIAddress': u'地址',
        'EITopEdu': u'最高学历',
        'EIGraduateYear': u'毕业年份',
        'EIGraduateSchool': u'毕业学校',
        'EIProfession': u'专业',
        'EIPhoneNum': u'手机号码',
        'EIResume': u'简历地址',
        'EIOrder_City': u'订阅城市',
        'EIOrder_Position': u'订阅职位'
    }
    column_list = ('EIName','EIBirthday','EISex','EIHeadPic','EIAddress','EITopEdu','EIGraduateYear','EIGraduateSchool','EIProfession','EIPhoneNum','EIResume','EIOrder_City','EIOrder_Position')
    column_searchable_list = ('EIName','EIBirthday','EISex','EIHeadPic','EIAddress','EITopEdu','EIGraduateYear','EIGraduateSchool','EIProfession','EIPhoneNum','EIResume','EIOrder_City','EIOrder_Position')
    column_filters = ('EIName','EIBirthday','EISex','EIHeadPic','EIAddress','EITopEdu','EIGraduateYear','EIGraduateSchool','EIProfession','EIPhoneNum','EIResume','EIOrder_City','EIOrder_Position')



    def __init__(self, session, **kwargs):
        super(tblemployeeinfoModelView, self).__init__(tblemployeeinfo, session, **kwargs)


class tblcompanyinfoModelView(sqla.ModelView):

    def is_accessible(self):
        return flask_login.current_user.is_authenticated

    can_create = True

    can_view_details = True
    can_edit = True  # 能编辑

    column_labels = {
        'CIName': u'公司名称',
        'CIOtherName': u'公司别称',
        'CILogo': u'公司Logo',
        'CIIndustry': u'所属行业',
        'CIProperty': u'公司性质',
        'CIScale': u'公司规模',
        'CIBLR_num': u'营业执照注册号',
        'CIBLR_pic': u'营业执照',
        'CIIntro': u'公司简介',
        'CILinkName': u'联系人',
        'CILinkPhone': u'招聘电话',
        'CIWebsite': u'公司网址',
        'CIWelfare': u'公司福利',
        'CIEnvirPics': u'公司图片',
        'CIProCityAddress': u'公司省市地址',
        'CISpecificAddress': u'公司具体地址',
        'CILongitude': u'公司经度',
        'CILatitude': u'公司纬度',
        'CIState': u'公司状态',
    }
    column_list = ('CIName','CIOtherName','CILogo','CIBLR_num','CIBLR_pic','CIProCityAddress','CISpecificAddress','CILongitude','CILatitude','CIState')
    column_searchable_list = ('CIName','CIOtherName','CILogo','CIIndustry','CIProperty','CIScale','CIBLR_num','CIBLR_pic','CIIntro','CILinkName','CILinkPhone','CIWebsite','CIWelfare','CIEnvirPics','CIProCityAddress','CISpecificAddress','CILongitude','CILatitude','CIState')
    column_filters = ('CIName','CIOtherName','CILogo','CIIndustry','CIProperty','CIScale','CIBLR_num','CIBLR_pic','CIIntro','CILinkName','CILinkPhone','CIWebsite','CIWelfare','CIEnvirPics','CIProCityAddress','CISpecificAddress','CILongitude','CILatitude','CIState')

    def _list_thumbnail_CILogo(view, context, model, name):
        return Markup('<img src="%s" style="width:100px;">' % (model.CILogo))

    def _list_thumbnail_CIBLR_pic(view, context, model, name):
        return Markup('<img src="%s" style="width:100px;">' % (model.CIBLR_pic))

    column_formatters = {
        'CILogo': _list_thumbnail_CILogo,
        'CIBLR_pic': _list_thumbnail_CIBLR_pic
    }

    def __init__(self, session, **kwargs):
        super(tblcompanyinfoModelView, self).__init__(tblcompanyinfo, session, **kwargs)



class tblpositioninfoModelView(sqla.ModelView):

    def is_accessible(self):
        return flask_login.current_user.is_authenticated

    can_create = True

    # list_template = 'mylist.html'
    can_view_details = True
    can_edit = False  # 不能编辑
    column_labels = {
        'PI_fk_CIID': u'公司ID',
        'PIName': u'职位名称',
        'PIClass': u'职位类别',
        'PIDuty': u'岗位职责',
        'PIQualification': u'任职资格',
        'PIWelfare': u'福利待遇',
        'PIWage': u'预计薪资',
        'PILowEdu': u'最低学历',
        'PIPacticeorFull': u'实习or全职',
        'PIWorkPlace': u'工作地点',
        'PINeedNum': u'岗位需求',
        'PIExperience': u'经验要求',
        'PIRegTime': u'发布时间',
        'PIEndTime': u'截止日期'
    }
    column_list = ('PI_fk_CIID','PIName','PIClass','PIDuty','PIQualification','PIWelfare','PIWage','PILowEdu','PIPacticeorFull','PIWorkPlace','PINeedNum','PIExperience','PIRegTime','PIEndTime')
    column_searchable_list = ('PI_fk_CIID','PIName','PIClass','PIDuty','PIQualification','PIWelfare','PIWage','PILowEdu','PIPacticeorFull','PIWorkPlace','PINeedNum','PIExperience','PIRegTime','PIEndTime')
    column_filters = ('PI_fk_CIID','PIName','PIClass','PIDuty','PIQualification','PIWelfare','PIWage','PILowEdu','PIPacticeorFull','PIWorkPlace','PINeedNum','PIExperience','PIRegTime','PIEndTime')

    def __init__(self, session, **kwargs):
        super(tblpositioninfoModelView, self).__init__(tblpositioninfo, session, **kwargs)


class tblcompanydynamicModelView(sqla.ModelView):

    def is_accessible(self):
        return flask_login.current_user.is_authenticated

    can_create = False

    # list_template = 'mylist.html'
    can_view_details = True
    can_edit = False  # 不能编辑

    column_labels = {
        'CDContent': u'动态内容',
        'CDTime': u'发布时间',
        'CD_fk_CIID': u'公司ID'
    }
    column_list = ( 'CDContent', 'CDTime', 'CD_fk_CIID')


    def __init__(self, session, **kwargs):
        super(tblcompanydynamicModelView, self).__init__(tblcompanydynamic, session, **kwargs)



class tblcampusemployerModelView(sqla.ModelView):

    def is_accessible(self):
        return flask_login.current_user.is_authenticated

    can_create = True

    # list_template = 'mylist.html'
    can_view_details = True
    can_edit = True  # 不能编辑

    column_labels = {
        'CEName': u'公司名称',
        'CELogo': u'公司Logo',
        'CECity': u'招聘地点',
        'CETimeStart': u'开始时间',
        'CETimeEnd': u'截止时间',
        'CECompanyUrl': u'网申地址'
    }
    column_list = ( 'CEName', 'CELogo', 'CECity','CETimeStart', 'CETimeEnd', 'CECompanyUrl')

    def _list_thumbnail_CELogo(view, context, model, name):
        return Markup('<img src="%s" style="width:100px;">' % (model.CELogo))

    column_formatters = {
        'CELogo': _list_thumbnail_CELogo
    }
    def __init__(self, session, **kwargs):
        super(tblcampusemployerModelView, self).__init__(tblcampusemployer, session, **kwargs)

# 创建登录登出视图
class MyAdminIndexView(flask_admin.AdminIndexView):

    @expose('/')
    def index(self):
        if not flask_login.current_user.is_authenticated:
            return redirect(url_for('.login_view'))
        return super(MyAdminIndexView, self).index()

    @expose('/login/', methods=('GET', 'POST'))
    def login_view(self):
        # handle user login
        form = LoginForm(request.form)
        if helpers.validate_form_on_submit(form):
            user = form.get_user()
            flask_login.login_user(user)

        if flask_login.current_user.is_authenticated:
            return redirect(url_for('.index'))

        self._template_args['form'] = form

        return super(MyAdminIndexView, self).index()

    @expose('/logout/')
    def logout_view(self):
        flask_login.logout_user()
        return redirect(url_for('.index'))


# flask默认视图
@app.route('/')
def index():
    return render_template('index.html')

init_login()   # 初始化flask-login
admin = flask_admin.Admin(app, 'jianshu', index_view=MyAdminIndexView(), base_template='my_master.html')   # 创建admin
# 添加视图
admin.add_view(tbluserModelView(db.session, name=u'用户管理'))
admin.add_view(tblemployeeinfoModelView(db.session, name=u'求职者管理'))
admin.add_view(tblcompanyinfoModelView(db.session, name=u'公司管理'))
admin.add_view(tblpositioninfoModelView(db.session, name=u'职位管理'))
admin.add_view(tblcompanydynamicModelView(db.session, name=u'动态管理'))
admin.add_view(tblcampusemployerModelView(db.session, name=u'校招管理'))
if __name__ == '__main__':
    # Start app
    app.run(debug=True)
