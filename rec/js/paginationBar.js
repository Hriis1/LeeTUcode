function paginationBar(pageCount, pageNum, pageBarLength, filterParam){
    $(document).ready (function(){
        const pageItem="<li class='page-item'><a class='page-link'></a></li>";
        for (let i=0; i<pageCount&&i<pageBarLength; i++)
        {
            $("ul.pagination").append(pageItem);
        }

        let startPageIdx=0;
        let endPageIdx=$("ul.pagination").children().length-1;
        let curPage=1;
        let pLink=$("a.page-link");
        if (pageCount>pageBarLength)
        {
            
            //adds a link to the first page if there isnt space for it
            if (pageNum>pageBarLength/2+1)
            {
                
                pLink.eq(startPageIdx).html("1");
                pLink.eq(startPageIdx++).attr("href", `courses.php?page=1${filterParam}`);
                pLink.eq(startPageIdx++).html("...");
                curPage=Math.min(pageNum-Math.floor(pageBarLength/2-2), pageCount-Math.floor(pageBarLength-4)-1);
            }
            //adds a link to the last page if there isnt space for it
            if (pageNum<pageCount-pageBarLength/2)
            {
                pLink.eq(endPageIdx).html(pageCount);
                pLink.eq(endPageIdx--).attr("href", `courses.php?page=${pageCount}${filterParam}`);
                pLink.eq(endPageIdx--).html("...");
            }
        }
        for (let i=startPageIdx; i<=endPageIdx; i++, curPage++)
        {
            pLink.eq(i).html(curPage);
            pLink.eq(i).attr("href", `courses.php?page=${curPage}${filterParam}`);
        }
        if (pageNum>1) 
        {
            $("ul.pagination").prepend(pageItem);
            $("a.page-link").first().html("<");
            $("a.page-link").first().attr("href", `courses.php?page=${(pageNum-1)}${filterParam}`);
        }
        if (pageNum<pageCount) 
        {
            $("ul.pagination").append(pageItem);
            $("a.page-link").last().html(">");
            $("a.page-link").last().attr("href", `courses.php?page=${(pageNum+1)}${filterParam}`);
        }
        $(`a[href$="page=${pageNum}"],a[href*="page=${pageNum}&"]`).addClass("active");
        });
}