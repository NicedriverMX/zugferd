<?php

function stricontains(string $haystack, string $needle): bool
{
    return str_contains(strtolower($haystack), strtolower($needle));
}

function correctAuthor(string $author): string
{
    if ($author == "horstoeko" || $author == "ruff" || $author == "Daniel Erling") {
        $author = "HorstOeko";
    }

    return $author;
}

function correctSubject(string $commitSubject, ?array &$issues): string
{
    $commitSubject = str_replace('[UPDATE-FEATURE]', '', $commitSubject);
    $commitSubject = str_replace('[TEST-FEATURE]', '', $commitSubject);
    $commitSubject = str_replace('[UPDATE2-FEATURE]', '', $commitSubject);

    $issues = [];

    if (preg_match_all('/#\d+\b/', $commitSubject, $matches)) {
        $issues = array_unique($matches[0]);
    }

    foreach ($issues as $issue) {
        $commitSubject = str_replace($issue, '', $commitSubject);
    }

    if (str_starts_with($commitSubject, 'Merge pull request')) {
        $commitSubject = 'Merged PR';
    }

    return trim($commitSubject);
}

function mustHideCommit(?string $commitHash = "", ?string $commitAuthor = "", ?string $commitDate = "", ?string $commitSubject = ""): bool
{
    if (!$commitSubject) {
        return true;
    }

    if (
        stricontains($commitSubject, '[DOC') ||
        stricontains($commitSubject, '[INFR') ||
        stricontains($commitSubject, 'Added CheckStyöe Script to composer') ||
        stricontains($commitSubject, 'Added dependabot.yml') ||
        stricontains($commitSubject, 'Added PHP8.4 Build') ||
        stricontains($commitSubject, 'Added single workflow for PHP 8.4') ||
        stricontains($commitSubject, 'Added WIKI-Update workflow') ||
        stricontains($commitSubject, 'build.ci') ||
        stricontains($commitSubject, 'build.release') ||
        stricontains($commitSubject, 'buildv2') ||
        stricontains($commitSubject, 'build.yml') ||
        stricontains($commitSubject, 'maintain-issues-stale') ||
        stricontains($commitSubject, 'Class Documentation (Wiki) Generator improved') ||
        stricontains($commitSubject, 'Class markdown generation for the wiki') ||
        stricontains($commitSubject, 'Code styling') ||
        stricontains($commitSubject, 'composer.json') ||
        stricontains($commitSubject, 'Documentation') ||
        stricontains($commitSubject, 'Enable all sources in gencodelists.php') ||
        stricontains($commitSubject, 'Fix .gitgnore') ||
        stricontains($commitSubject, 'Fix build.wiki.yml') ||
        stricontains($commitSubject, 'Fix Class doc generation script') ||
        stricontains($commitSubject, 'Fix class doc generator script') ||
        stricontains($commitSubject, 'Fix DocBlock') ||
        stricontains($commitSubject, 'Fix docs') ||
        stricontains($commitSubject, 'Fix for generator of Wiki class documentation') ||
        stricontains($commitSubject, 'Fix genmethoddocs') ||
        stricontains($commitSubject, 'Fix GitHub workflows') ||
        stricontains($commitSubject, 'Fix maintain-issues-stale.yml') ||
        stricontains($commitSubject, 'Fix name of release workflow') ||
        stricontains($commitSubject, 'Fix PHPStan Config') ||
        stricontains($commitSubject, 'Fix README.md') ||
        stricontains($commitSubject, 'Fix README.mD') ||
        stricontains($commitSubject, 'Fix workflow') ||
        stricontains($commitSubject, 'Fixed CheckStyle Issues') ||
        stricontains($commitSubject, 'Fixed Fixed genmethoddocs') ||
        stricontains($commitSubject, 'Fixed PHPMD issue') ||
        stricontains($commitSubject, 'Format build.phpall.ant') ||
        stricontains($commitSubject, 'Improved class documentation generator script') ||
        stricontains($commitSubject, 'Improved DocBlocks') ||
        stricontains($commitSubject, 'Improved docs') ||
        stricontains($commitSubject, 'Improved linting in github actions') ||
        stricontains($commitSubject, 'Improved matrix build') ||
        stricontains($commitSubject, 'issue templates') ||
        stricontains($commitSubject, 'Matrix build') ||
        stricontains($commitSubject, 'Merge branch') ||
        stricontains($commitSubject, 'Moved pull_request_template.md') ||
        stricontains($commitSubject, 'New Release workflow added') ||
        stricontains($commitSubject, 'PHPDoc') ||
        stricontains($commitSubject, 'README.md') ||
        stricontains($commitSubject, 'Removed build.php84.ant.yml') ||
        stricontains($commitSubject, 'Removed dependabot.yml') ||
        stricontains($commitSubject, 'Reordered methods') ||
        stricontains($commitSubject, 'Reorganized test') ||
        stricontains($commitSubject, 'Run Release Build on PHP 8.4') ||
        stricontains($commitSubject, 'Set XDEBUG mode') ||
        stricontains($commitSubject, 'Update build.wiki.yml') ||
        stricontains($commitSubject, 'Update PHPDoc') ||
        stricontains($commitSubject, 'Update wiki on release build') ||
        stricontains($commitSubject, 'Updated action versions in all workflows') ||
        stricontains($commitSubject, 'Updated README.md') ||
        stricontains($commitSubject, 'Updated README.README.md') ||
        stricontains($commitSubject, 'Updated script to create class overview for WIKI') ||
        stricontains($commitSubject, 'Run CI\'s on PR\'s') ||
        stricontains($commitSubject, 'Added badges') ||
        stricontains($commitSubject, 'Fix Mock Tests') ||
        stricontains($commitSubject, 'More code coverage') ||
        stricontains($commitSubject, 'Code Doc Styling') ||
        stricontains($commitSubject, 'Updated actions') ||
        stricontains($commitSubject, 'Exclude .github-folder from action runner') ||
        stricontains($commitSubject, 'config.yml') ||
        stricontains($commitSubject, 'CONTRIBUTING.md') ||
        stricontains($commitSubject, 'SECURITY.md') ||
        stricontains($commitSubject, 'CODE_OF_CONDUCT.md') ||
        stricontains($commitSubject, 'pull request template') ||
        stricontains($commitSubject, 'Excluded examples folder from workflow runs') ||
        stricontains($commitSubject, 'Allow manually run specific workflows') ||
        stricontains($commitSubject, 'Added issue template for a question') ||
        stricontains($commitSubject, 'Fix template for bug-report') ||
        stricontains($commitSubject, 'Added issue template for a new feature') ||
        stricontains($commitSubject, 'Fix bug report template') ||
        stricontains($commitSubject, 'pull_request_template.md') ||
        stricontains($commitSubject, 'Fixed CheckStyle Errors') ||
        stricontains($commitSubject, 'Cleanup Buildscript') ||
        stricontains($commitSubject, 'Ignore changes on MD-Files') ||
        stricontains($commitSubject, 'Reformatted code') ||
        stricontains($commitSubject, 'Code beautify') ||
        stricontains($commitSubject, 'Code cleabing') ||
        stricontains($commitSubject, 'Code cleaning') ||
        stricontains($commitSubject, 'Used PHPCBF to make clean code') ||
        stricontains($commitSubject, 'Used PHPCBF to make clean code') ||
        stricontains($commitSubject, 'CheckStyle') ||
        stricontains($commitSubject, 'Test reorganization') ||
        stricontains($commitSubject, 'Made tests ready for PHPUnit10') ||
        stricontains($commitSubject, 'Removed phpdox') ||
        stricontains($commitSubject, 'Rename workflows') ||
        stricontains($commitSubject, 'Removed useless .Jenkinsfile') ||
        stricontains($commitSubject, 'Fix github action') ||
        stricontains($commitSubject, 'Build infrastructure') ||
        stricontains($commitSubject, 'Enhance build target') ||
        stricontains($commitSubject, 'Fix ANT build script') ||
        stricontains($commitSubject, 'Rename release workflow file') ||
        stricontains($commitSubject, 'Fix build scrip') ||
        stricontains($commitSubject, 'Removed temp files') ||
        stricontains($commitSubject, 'gitignore') ||
        stricontains($commitSubject, 'Removed sami') ||
        stricontains($commitSubject, 'GitHub-Actions') ||
        stricontains($commitSubject, 'Fix phpdox download url') ||
        stricontains($commitSubject, 'Added composer scripts') ||
        stricontains($commitSubject, 'Added build workflow') ||
        stricontains($commitSubject, 'Added release workflow') ||
        stricontains($commitSubject, 'Added action for php') ||
        stricontains($commitSubject, 'Phing') ||
        stricontains($commitSubject, 'Fix tests') ||
        stricontains($commitSubject, 'Excluded entities subdirectory from phpdox') ||
        stricontains($commitSubject, 'Fixed code with PHPCBF using PSR12 Standard') ||
        stricontains($commitSubject, 'Added PHPCS Rulez for PSR12') ||
        stricontains($commitSubject, 'Include PHPStan to ANT buildscript') ||
        stricontains($commitSubject, 'Better code quality using phpstan') ||
        stricontains($commitSubject, 'Code cleanup') ||
        stricontains($commitSubject, 'Added workflows/build.ant.yml') ||
        (strcasecmp("Fixes", $commitSubject) === 0) ||
        (strcasecmp("Fix", $commitSubject) === 0)
    ) {
        return true;
    }

    return false;
}

function getMarkDown($prevTag, $currTag)
{
    $markDown = [];

    echo "Getting commits from $prevTag to $currTag" . PHP_EOL;

    $commitStr = shell_exec(sprintf('git log %s..%s --oneline --format="%%h|%%an|%%ad|%%s"', $prevTag, $currTag));

    if (is_null($commitStr) || $commitStr === false) {
        return $markDown;
    }

    $commits = array_filter(explode("\n", trim($commitStr)));

    if (empty($commits)) {
        return $markDown;
    }

    $noOfHiddenCommits = 0;

    $commits = array_filter($commits, function($commit) use (&$noOfHiddenCommits) {
        list($commitHash, $commitAuthor, $commitDate, $commitSubject) = explode("|", $commit);
        $hidden = mustHideCommit($commitHash, $commitAuthor, $commitDate, $commitSubject);
        if ($hidden) {
            $noOfHiddenCommits++;
        }
        return !$hidden;
    });

    $markDown[] = sprintf('## %s', $currTag);
    $markDown[] = '';

    if (!empty($commits)) {
        $markDown[] = sprintf('``Previous version %s``', $prevTag);
        $markDown[] = '';
        $markDown[] = '| Hash    | Date    | Author  | Subject  | Issue(s)';
        $markDown[] = '| :------ | :------ | :------ | :------- | :-----------: ';

        foreach ($commits as $commit) {
            list($commitHash, $commitAuthor, $commitDate, $commitSubject) = explode("|", $commit);

            if (mustHideCommit($commitHash, $commitAuthor, $commitDate, $commitSubject)) {
                $noOfHiddenCommits++;
                continue;
            }

            $time = (new \DateTime())->setTimeStamp(strtotime($commitDate))->setTimezone(new DateTimeZone('Europe/Berlin'));

            $commitDate = $time->format('Y-m-d H:i:s T');
            $commitAuthor = correctAuthor($commitAuthor);
            $commitSubject = correctSubject($commitSubject, $commitIssues);

            $markDown[] = sprintf('| [%1$s](https://github.com/horstoeko/zugferd/commit/%1$s) | %2$s | %3$s | %4$s | %5$s', $commitHash, $commitDate, $commitAuthor, $commitSubject, implode(", ", $commitIssues));
        }

        $markDown[] = '';
    }

    if ($noOfHiddenCommits == 1) {
        $markDown[] = ":exclamation: _There is one internal commit_";
        $markDown[] = '';
    }
    if ($noOfHiddenCommits > 1) {
        $markDown[] = sprintf(":exclamation: _There are %s internal commit(s)_", $noOfHiddenCommits);
        $markDown[] = '';
    }

    return $markDown;
}

function printMarkdown(array $markDown): void
{
    foreach ($markDown as $_) {
        echo $_ . PHP_EOL;
    }
}

if (!isset($argv[1]) && !isset($argv[2])) {
    $lastHash = trim(shell_exec('git rev-list --tags --skip=1 --max-count=1'));
    $prevTag = trim(shell_exec(sprintf('git describe --abbrev=0 --tags %s', $lastHash)));
    $currTag = trim(shell_exec('git describe --tags --abbrev=0'));
    file_put_contents(dirname(__FILE__) . '/CHANGELOG.md', implode("\n", getMarkDown($prevTag, $currTag)));
} elseif (isset($argv[1]) && $argv[1] == "all") {
    $completeMarkDown = [];
    $allTags = explode("\n", trim(shell_exec('git tag --sort=-creatordate')));
    $allTags = array_filter($allTags, function ($tag) {
        return str_starts_with($tag, "v0.") === false;
    });
    foreach ($allTags as $currTagKey => $currTag) {
        if (!isset($allTags[$currTagKey + 1])) {
            continue;
        }
        $prevTag = $allTags[$currTagKey + 1];
        $markDown = getMarkDown($prevTag, $currTag);
        foreach ($markDown as $markDownLine) {
            $completeMarkDown[] = $markDownLine;
        }
    }
    file_put_contents(dirname(__FILE__) . '/CHANGELOG.md', implode("\n", $completeMarkDown));
} else {
    $prevTag = $argv[1];
    $currTag = $argv[2];
    file_put_contents(dirname(__FILE__) . '/CHANGELOG.md', implode("\n", getMarkDown($prevTag, $currTag)));
}