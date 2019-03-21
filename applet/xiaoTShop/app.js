var util = require('./utils/util.js');
var api = require('./config/api.js');
var user = require('./services/user.js');

App({
  onLaunch: function() {
    //获取用户的登录信息
    user.checkLogin().then(res => {
      console.log('app login')
      this.globalData.userInfo = wx.getStorageSync('userInfo');
      this.globalData.token = wx.getStorageSync('token');
    }).catch(() => {

    });
  },

  globalData: {
    userInfo: {
      nickname: 'Hi,游客',
      username: '点击去登录',
      avatar: '/static/images/default.header.png'
    },
    token: '',
    // new
    isIphoneX: false,
    userInfo: null
  },
  onShow: function() {
    let that = this;
    wx.getSystemInfo({
      success: res => {
        console.log('手机信息res'+res.model)
        let modelmes = res.model;
        if (modelmes.search('iPhone X') != -1) {
          that.globalData.isIphoneX = true
        }
      }
    })
  }

})