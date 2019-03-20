var util = require('../../utils/util.js');
var api = require('../../config/api.js');

var app = getApp()
Page({
    data: {
        keywrod: '',
        searchStatus: false,
        goodsList: [],
        helpKeyword: [],
        historyKeyword: [],
      historyKeywords: [],
        categoryFilter: false,
        currentSortType: 'default',
        currentSortOrder: '',
        filterCategory: [],
        defaultKeyword: {},
        hotKeyword: [],
        page: 1,
        size: 10,
        currentSortType: 'id',
        currentSortOrder: 'desc',
        categoryId: 0,
        scrollTop: 0,
        scrollHeight: 0
    },
    //事件处理函数
    closeSearch: function() {
        wx.navigateBack()
    },
    clearKeyword: function() {
        this.setData({
            keyword: '',
            searchStatus: false,
            goodsList:[]
        });
      this.searchHistory();
    },
    onLoad: function() {

      this.getSearchKeyword();
      this.searchHistory();
      this.getCategory();
        var that=this;
      wx.getSystemInfo({
        success: function (res) {
          that.setData({
            scrollHeight: res.windowHeight
          });
        }
      });
    },
    searchHistory() {
      let that = this;
      util.request(api.SearchHistory).then(function (result) {
        that.setData({
          historyKeywords: result.data
        });
        
      })
      
    },
    getCategory() {
        let that = this;
      util.request(api.CatalogList).then(function (result) {
        that.setData({

          filterCategory: result.data.categoryList,
        });
      })
    },

    getSearchKeyword() {
        let that = this;
        util.request(api.SearchIndex).then(function(res) {
            if (res.errno === 0) {
                that.setData({
                    historyKeyword: res.data.historyKeywordList,
                    defaultKeyword: res.data.defaultKeyword,
                    hotKeyword: res.data.hotKeywordList
                });
            }
        });
    },

    inputChange: function(e) {

        this.setData({
            keyword: e.detail.value,
            searchStatus: false,
          goodsList:[]
        });
        // this.getHelpKeyword();
    },
    getHelpKeyword: function() {
        let that = this;
        util.request(api.SearchHelper, {
            keyword: that.data.keyword
        }).then(function(res) {
            if (res.errno === 0) {
                that.setData({
                    helpKeyword: res.data
                });
            }
        });
    },
    inputFocus: function() {
        this.setData({
            searchStatus: false,
            goodsList: [],
          scrollTop: 0,
          page: 1
        });

        if (this.data.keyword) {
            this.getHelpKeyword();
        }
    },
    clearHistory: function() {
      var that= this
      util.request(api.SearchClearHistory     )
        .then(function (res) {
          console.log('清除成功');
          that.setData({
            historyKeywords: []
          })
        });
       
    },
    getGoodsList: function() {
        let that = this;
        util.request(api.GoodsList, {
            keyword: that.data.keyword,
            page: that.data.page,
            size: that.data.size,
            sort: that.data.currentSortType,
            order: that.data.currentSortOrder,
            categoryId: that.data.categoryId
        }).then(function(res) {
            if (res.code == 200) {
                that.setData({
                    searchStatus: true,
                    categoryFilter: false,
                    goodsList: res.data,
                    // filterCategory: res.data.filterCategory,
                    // page: res.meta.currentPage,
                    size: res.meta.per_page
                });
            }
            //重新获取关键词
            that.getSearchKeyword();
          // that.searchHistory();
        });
    },
// new
  lower() {

    wx.showLoading({
      title: '加载中',
      icon: 'loading',
    });
    let that = this;
    
      var result = this.data.goodsList;
    that.data.page = that.data.page + 1,
        console.log(that.data.page)
      util.request(api.GoodsList, {
        keyword: that.data.keyword,
        page: that.data.page,
        size: that.data.size,
        sort: that.data.currentSortType,
        order: that.data.currentSortOrder,
        categoryId: that.data.categoryId
      }).then(function (res) {
        if (res.code == 200) {
            that.setData({
              goodsList: result.concat(res.data),
              searchStatus :true
            });
            wx.hideLoading();
        }
      });
    },
// end

    onKeywordTap: function(event) {
        this.getSearchResult(event.target.dataset.keyword.keyword);
    },
    getSearchResult(keyword) {
        this.setData({
            keyword: keyword,
            page: 1,
            categoryId: 0,
            goodsList: []
        });

        this.getGoodsList();
    },
    openSortFilter: function(event) {
        let currentId = event.currentTarget.id;
        switch (currentId) {
            case 'categoryFilter':
                this.setData({
                    'categoryFilter': !this.data.categoryFilter,
                    'currentSortOrder': 'asc'
                });
                break;
            case 'priceSort':
                let tmpSortOrder = 'asc';
                if (this.data.currentSortOrder == 'asc') {
                    tmpSortOrder = 'desc';
                }
                this.setData({
                    'currentSortType': 'price',
                    'currentSortOrder': tmpSortOrder,
                    'categoryFilter': false
                });

                this.getGoodsList();
                break;
            default:
                //综合排序
                this.setData({
                    'currentSortType': 'default',
                    'currentSortOrder': 'desc',
                    'categoryFilter': false
                });
                this.getGoodsList();
        }
    },
    selectCategory: function(event) {
        let currentIndex = event.target.dataset.categoryIndex;//xiabiao
        let filterCategory = this.data.filterCategory;
        let currentCategory = null;
        for (let key in filterCategory) {
            if (key == currentIndex) {
                filterCategory[key].selected = true;
                currentCategory = filterCategory[key];
            } else {
                filterCategory[key].selected = false;
            }
      }
        this.setData({
            'filterCategory': filterCategory,
            'categoryFilter': false,
            categoryId: currentCategory.id,
            page: 1,
            goodsList: []
        });
        this.getGoodsList();
    },
    onKeywordConfirm(event) {
        this.getSearchResult(event.detail.value);
    }
})